<?php namespace Admin;

use App;
use Category;
use DB;
use Input;
use Request;
use View;


class CategoriesController extends \BaseController
{
    public function __construct()
    {
        // filter to validate POST requests
        $this->beforeFilter(function () {
            $this->request = (object)Input::all();
            if (!Request::ajax() ||
                !in_array($this->request->action, ["addCategory", "deleteCategory", "renameCategory", "moveCategory"])
                //(\Validator::make(['name' => $this->request->name], ["name" => ["required", "regex:/^[\w\p{Cyrillic}\040,.-_']+$/u"]])->fails())
            ) {
                App::abort(405);
            }
        }, ["on" => "post"]);
    }

    public function getIndex()
    {

        return View::make("admin.categories.list");
    }


    public function postIndex()
    {
        DB::beginTransaction();

        switch ($this->request->action) {
            case "renameCategory":
                $status = Category::renameNode($this->request->id, $this->request->name, $this->request->icon);
                break;

            case "addCategory":
                $status = Category::addNode($this->request->name, $this->request->icon);
                DB::commit();

                return $status;
                break;

            case "deleteCategory":

                $status = Category::removeNode($this->request->id, $this->request->name);
                break;

            case "moveCategory":

                $status = Category::moveNode($this->request->id, $this->request->to, $this->request->direction,
                    $this->request->parent_id);
                break;
        }

        \Cache::forget('categories.composer');

        if (!isset($status) || $status == null) {
            DB::rollback();
            App::abort(400);
        }

        DB::commit();


    }
}