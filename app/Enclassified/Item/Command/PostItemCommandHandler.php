<?php namespace Enclassified\Item\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class PostItemCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {

        dd($command);

        try {
            $item = \Item::post($command->category_id, $command->type, $command->title, $command->description, $command->amount, $command->negotiable,  $command->location_id, $command->email, $command->phone, $command->seller_name);

            if($command->multipart_upload) {

            } else {
                $pictures_id = explode(',',$command->pictures_id);

                $item->attachPictures($pictures_id);
            }

            $result['success'] = true;
            $result['message'] = "Item '{$command->title}' was been posted successfully";
            $result['payload'] = $item;
        } catch(\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        $this->dispatchEventsFor($item);

        return $result;
    }

}