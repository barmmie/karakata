<?php namespace Karakata\Item\Command;

use Auth;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateItemCommandHandler implements CommandHandler
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
            $item = \Item::where('id', $command->id)
                ->firstOrFail();


            if (! ($item->user_id == Auth::user()->id || Auth::user()->isAdmin()))
            {
                $result['success'] = false;
                $result['message'] = trans('phrases.operation_failed');

                return $result;

            }





            $item->update([
                'category_id' => $command->category_id,
                'type' => $command->type,
                'title' => $command->title,
                'description' => $command->description,
                'amount' => $command->amount,
                'negotiable' => $command->negotiable,
                'location_id' => $command->location_id,
                'email' => $command->email,
                'phone' => $command->phone,
                'seller_name' => $command->seller_name,
                'keywords' => $command->keywords
            ]);

            if ($command->multipart_upload) {

                foreach ($command->uploaded_files as $file) {
                    \Picture::upload($file, $item->id);
                }

            } else {
                $pictures_id = explode(',', $command->pictures_id);

                $item->attachPictures($pictures_id);
            }

            $this->dispatchEventsFor($item);


            $result['success'] = true;
            $result['message'] =  trans('phrases.item_updated_successfully', ['title' => $command->title]);
            $result['payload'] = $item;
        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }


        return $result;
    }

}