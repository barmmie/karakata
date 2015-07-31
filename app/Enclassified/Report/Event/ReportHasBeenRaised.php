<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/31/15
 * Time: 12:18 AM
 */

namespace Enclassified\Report\Event;


class ReportHasBeenRaised {
    public $report;
    public function __construct($report){
        $this->report = $report;
    }
}