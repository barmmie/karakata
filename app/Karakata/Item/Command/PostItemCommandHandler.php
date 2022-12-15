<?php namespace Karakata\Item\Command;

use Setting;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class PostItemCommandHandler implements CommandHandler
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
            $item = \Item::post($command->category_id, $command->type, $command->title, $command->description,
                $command->amount, $command->negotiable, $command->location_id, $command->email, $command->phone,
                $command->seller_name,$command->keywords);

            if ($command->multipart_upload) {

                foreach ($command->uploaded_files as $file) {
                    \Picture::upload($file, $item->id);
                }

            } else {
                $pictures_id = explode(',', $command->pictures_id);

                $item->attachPictures($pictures_id);
            }

            $this->dispatchEventsFor($item);

            if(Setting::get('require_item_verification', '1') != '1') {
                $item->approve();
            }


            $result['success'] = true;
            $result['message'] = trans('phrases.item_posted_successfully', ['title' => $command->title]);
            $result['payload'] = $item;
        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }


        return $result;
    }

}