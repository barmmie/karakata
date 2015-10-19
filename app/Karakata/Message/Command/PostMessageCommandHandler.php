<?php namespace Karakata\Message\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class PostMessageCommandHandler implements CommandHandler
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
            $message = \Message::post($command->name, $command->email, $command->content, $command->item_id);
            $result['success'] = true;
            $result['message'] = trans('phrases.message_posted');

            $this->dispatchEventsFor($message);


        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        return $result;


    }

}