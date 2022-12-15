<?php namespace Karakata\Report\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class ReportItemCommandHandler implements CommandHandler
{

    use DispatchableTrait;

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        try {
            $report = \Report::post($command->content, $command->item_id);
            $result['success'] = true;
            $result['message'] = trans('phrases.report_received');

            $this->dispatchEventsFor($report);


        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

}