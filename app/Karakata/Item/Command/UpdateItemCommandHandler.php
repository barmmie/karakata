<?php namespace Karakata\Item\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateItemCommandHandler implements CommandHandler {

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
            $item = \Item::where('id', $command->id)
                            ->where('user_id', \Auth::user()->id)->firstOrFail();


            $item->update(['category_id' => $command->category_id,
                                    'type' => $command->type,
                                    'title' => $command->title,
                                    'description' => e($command->description),
                                    'amount' => $command->amount,
                                    'negotiable' => $command->negotiable,
                                    'location_id' => $command->location_id,
                                    'email' => $command->email,
                                    'phone' => $command->phone,
                                    'seller_name' => $command->seller_name]);

            if($command->multipart_upload) {

                foreach($command->uploaded_files as $file){
                    \Picture::upload($file, $item->id);
                }

            } else {
                $pictures_id = explode(',',$command->pictures_id);

                $item->attachPictures($pictures_id);
            }

            $this->dispatchEventsFor($item);


            $result['success'] = true;
            $result['message'] = "Item '{$command->title}' was been updated successfully";
            $result['payload'] = $item;
        } catch(\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }


        return $result;
    }

}