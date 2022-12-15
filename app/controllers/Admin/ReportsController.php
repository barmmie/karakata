<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 8/19/15
 * Time: 12:11 AM
 */

namespace Admin;

use Input;
use Redirect;
use Report;
use View;

class ReportsController extends \BaseController
{


    public function index($status = 'unreviewed')
    {
        $reports = Report::with('item')->orderBy('created_at', 'desc');

        switch ($status) {
            case 'all':
                break;
            case 'reviewed':
                $reports->readOnly();
                break;
            case 'unreviewed':
                $reports->unreadOnly();
                break;
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
        } catch (\Exception $e) {
            flashError('Report could not be marked as reviewed', $e->getMessage());
        }

        return Redirect::back();
    }

    public function markAsUnreviewed($id)
    {
        $report = Report::findOrFail($id);
        try {
            $report->markAsUnread();
            flashSuccess('Report has been marked as unreviewed');
        } catch (\Exception $e) {
            flashError('Report could not be marked as unreviewed', $e->getMessage());
        }

        return Redirect::back();
    }

    public function delete($id)
    {
        $report = Report::findOrFail($id);
        try {
            $report->delete();
            flashSuccess('Report has been deleted');
        } catch (\Exception $e) {
            flashError('Report could not be deleted', $e->getMessage());
        }

        return Redirect::back();
    }
}