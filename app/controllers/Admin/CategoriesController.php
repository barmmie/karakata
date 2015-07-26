<?php namespace Admin;

use Category, Request, View, DB, Input, App;


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
            ) App::abort(405);
        }, ["on" => "post"]);
    }

    public function getIndex()
    {
        $categories = Category::fetchTree();

        return View::make("admin.categories.list")->with("categoriesData", $categories);
    }


    public function postIndex()
    {
        DB::beginTransaction();

        switch ($this->request->action) {
            case "renameCategory":
                $status = Category::renameNode($this->request->id, $this->request->originalname, $this->request->name);
                break;

            case "addCategory":

                $status = Category::addNode($this->request->name);
                return $status;
                break;

            case "deleteCategory":

                $status = Category::removeNode($this->request->id, $this->request->name);
                break;

            case "moveCategory":

                $status = Category::moveNode($this->request->id, $this->request->to, $this->request->direction, $this->request->parent_id);
                break;
        }

        if (!isset($status) || $status == null) {
            DB::rollback();
            App::abort(400);
        }

        DB::commit();

    }
}