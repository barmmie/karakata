<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/22/15
 * Time: 11:57 AM
 */
class Category extends \Kalnoy\Nestedset\Node
{
    protected $fillable = array('title', 'icon');


    public static function boot()
    {
        parent::boot();

        static::saved(function ($category) {
            static::where('id', $category->id)
                ->update(['slug' => $category->id . '-' . Str::slug($category->title, '-')]);
        });

	    static::deleting(function ($loc) {
		    $loc->items()->delete();
	    });

    }

    public static function fetchTree($fetchItemsCount = false)
    {
        $cats = static::withoutRoot();

        if ($fetchItemsCount) {
            $cats = $cats->with('active_items');
        }

        return $cats->get(['id', 'icon', 'title as label', '_lft', '_rgt', 'parent_id', 'slug'])->toTree();
    }

    public static function renameNode($id, $name, $icon)
    {
        return static::where("id", $id)
            ->update(["title" => $name, "icon" => $icon]);
    }

    public static function removeNode($id, $title)
    {
        try {
            $category = static::where("title", $title)
                ->where("id", $id)
                ->firstOrFail();

            $status = $category->delete();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $status = false;
        }

        return $status;

    }

    public static function createTestNodes()
    {
        $cat1 = Category::addNode('Test');
        $cat2 = Category::addNode('Test 2');
        $cat3 = Category::addNode('test 3');
        $cat4 = Category::addNode('test 4');


        Category::moveNode($cat2['id'], $cat1['id'], 'inside', $cat1['id']);
        Category::moveNode($cat3['id'], $cat1['id'], 'inside', $cat1['id']);
        Category::moveNode($cat4['id'], $cat2['id'], 'inside', $cat2['id']);

    }

    public static function addNode($title, $icon = 'search')
    {
        $newCategory = new static(['title' => $title, "icon" => $icon]);

        $rootCategory = static::root();

        if ($newCategory->appendTo($rootCategory)->save()) {

            return ["id" => $newCategory->id, "parent_id" => $rootCategory->parent_id];
        }

    }

    public static function moveNode($source, $dest, $direction, $parent_id)
    {
        // get source/target categories from DB
        $sourceCategory = static::find($source);
        $targetCategory = static::find($dest);


//&& ($sourceCategory->parent_id == $parent_id)
        if ($sourceCategory && $targetCategory) {
            switch ($direction) {
                case "inside" :
                    $status = $sourceCategory->prependTo($targetCategory)->save();
                    break;
                case "before" :
                    $status = $sourceCategory->before($targetCategory)->save();
                    break;
                case "after" :
                    $status = $sourceCategory->after($targetCategory)->save();
                    break;
            }
        }

        return $status;
    }

    public function active_items()
    {
        return $this->items()->approved();
//            ->where('status', Item::APPROVED_STATUS);
    }

    public function items()
    {
        return $this->hasMany('Item');
    }

    public function nestedKeys()
    {
        $categories = $this->descendants()->lists('id');

        $categories[] = $this->getKey();

        return $categories;

    }

    public function scopePopular($query, $limit = 6)
    {
        return $query
            ->select('categories.title', 'categories.slug as slug', 'parentcat.slug as parent_slug',
                DB::raw('count(items.category_id) as item_count'))
            ->join('items', function ($join) {
                $join->on('categories.id', '=', 'items.category_id')
                    ->where('categories.parent_id', '<>', 1)
                    ->where('items.status', '=', Item::APPROVED_STATUS);
            })
            ->join('categories as parentcat', function ($join) {
                $join->on('categories.parent_id', '=', 'parentcat.id');
            })
            ->groupBy('categories.id')
            ->orderBy('item_count', 'desc')
            ->limit($limit);
    }
}