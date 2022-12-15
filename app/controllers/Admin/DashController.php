<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/31/15
 * Time: 10:40 PM
 */

namespace Admin;

use Carbon\Carbon;
use DB;
use Input;
use Item;
use Redirect;
use Response;
use URL;
use View;

class DashController extends \BaseController
{

    public function dashboard()
    {

        $items_count = Item::count();
        $users_count = \User::count();
        $locations_count = \Location::count();
        $categories_count = \Category::withoutRoot()->count();


        return View::make('admin.dash.dashboard',
            compact('users_count', 'items_count', 'locations_count', 'categories_count'));
    }

    public function itemsByYear()
    {

        $year = Input::has('year') ? Input::get('year') : Carbon::now()->year;
        $month = Input::has('month') ? Input::get('month') : Carbon::now()->month;

        $items = Item::where(DB::raw('YEAR(created_at)'), '=', $year)
            ->where(DB::raw('MONTH(created_at)'), '=', $month)
            ->select([
                DB::Raw('count(items.id) as items_count'),
                DB::Raw('DATE_FORMAT(items.created_at, "%Y-%m-%d") day')
            ])
            ->groupBy('day')
            ->orderBy('items.created_at')
            ->get();

        $result = [];

        $items->map(function ($item) use (&$result) {
            $result[Carbon::parse($item->day)->toDateTimeString()] = (int)$item->items_count;
        });

        return $result;

    }

    public function itemsBylocation()
    {
        $items = Item::select([DB::Raw('count(items.id) as items_count'), 'locations.name as location_name'])
            ->join('locations', 'items.location_id', '=', 'locations.id')
            ->groupBy('items.location_id')
            ->orderBy('items.created_at')
            ->get();

        $result = [];

        $items->map(function ($item) use (&$result) {
            $result[] = [$item->location_name, $item->items_count];
        });

        return $result;
    }

}