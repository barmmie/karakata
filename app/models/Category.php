<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/22/15
 * Time: 11:57 AM
 */

class Category extends \Kalnoy\Nestedset\Node {
    protected $fillable = array('title');


    public static function boot()
    {
        parent::boot();



        static::deleted(function(){
            Cache::forget('categories_cache');
        });

        static::updated(function(){
            Cache::forget('categories_cache');
        });

        static::created(function(){
            Cache::forget('categories_cache');
        });

    }

    public static function fetchTree() {
//        return Cache::rememberForever('categories_cache', function () {
            return static::withoutRoot()->get(['id', 'title as label', '_lft', '_rgt', 'parent_id'])->toTree();
//        });
    }

    public static function renameNode($id, $originalname, $name) {
        return static::where("title", $originalname)
            ->where("id", $id)
            ->update(["title" => $name]);
    }

    public static function addNode($title){
        $newCategory = new static(['title' => $title]);

        $rootCategory = static::root();

        if ( $newCategory->appendTo($rootCategory)->save() ) {

            return ["id" => $newCategory->id, "parent_id" => $rootCategory->parent_id];
        }
        
    }

    public static function removeNode($id, $title){
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

    public static function moveNode($source, $dest, $direction, $parent_id){
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

    public static function createTestNodes(){
        $cat1 = Category::addNode('Test');
        $cat2 = Category::addNode('Test 2');
        $cat3 = Category::addNode('test 3');
        $cat4 = Category::addNode('test 4');


        Category::moveNode($cat2['id'], $cat1['id'], 'inside', $cat1['id'] );
        Category::moveNode($cat3['id'], $cat1['id'], 'inside', $cat1['id'] );
        Category::moveNode($cat4['id'], $cat2['id'], 'inside', $cat2['id'] );

    }
}