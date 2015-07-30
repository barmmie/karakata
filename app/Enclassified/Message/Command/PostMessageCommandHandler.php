<?php namespace Enclassified\Message\Command;

use Laracasts\Commander\CommandHandler;

class PostMessageCommandHandler implements CommandHandler {

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
            $result['message'] = 'Message posted successfully';

            $this->dispatchEventsFor($message);


        } catch(\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        return $result;


    }

}