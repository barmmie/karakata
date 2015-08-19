<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/19/15
 * Time: 12:11 AM
 */

namespace Admin;

use Input, Report, View, Redirect;

class ReportsController extends \BaseController {


    public function index($status = 'unreviewed')
    {
        $reports = Report::with('item')->orderBy('created_at', 'desc');

        switch ($status ) {
            case 'all':
            case 'reviewed':
                $reports->readOnly();
            case 'unreviewed':
                $reports->unreadOnly();
        }

        $reports = $reports->paginate(15);

        return View::make('admin.reports.index', compact('reports', 'status'));
    }


    public function markAsReviewed($id)
    {
        $report = Report::findOrFail($id);
        try {
            $report->markAsRead();
            flashSuccess('Report has been marked as reviewed');
        }catch(\Exception $e){
            flashError('Report couldn not be marked as reviewed', $e->getMessage());
        }

        return Redirect::back();
    }

    public function markAsUnreviewed($id)
    {
        $report = Report::findOrFail($id);
        try {
            $report->markAsUnread();
            flashSuccess('Report has been marked as unreviewed');
        }catch(\Exception $e){
            flashError('Report couldn not be marked as unreviewed', $e->getMessage());
        }

        return Redirect::back();
    }
}