<?php namespace Karakata\User\Command;

use Laracasts\Commander\CommandHandler;

class UpdateProfileCommandHandler implements CommandHandler
{

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        try {
            $user = \User::where('id', \Auth::id())->update(
                [
                    'full_name' => $command->full_name,
                    'phone' => $command->phone
                ]);
            $result['success'] = true;
            $result['message'] = trans('phrases.update_successful');

        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

}