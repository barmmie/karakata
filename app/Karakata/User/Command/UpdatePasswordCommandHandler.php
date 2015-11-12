<?php namespace Karakata\User\Command;

use Auth;
use Hash;
use Laracasts\Commander\CommandHandler;
use User;

class UpdatePasswordCommandHandler implements CommandHandler
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
            $user = User::find(Auth::id());

            if (Hash::check($command->current_password, $user->password) || $user->isSocial()) {
                $user->password = Hash::make($command->new_password);
                $user->save();

                $result['success'] = true;
                $result['message'] = trans('phrases.password_updated');
            } else {
                $result['success'] = false;
                $result['message'] = trans('password_doesnt_match');
            }


        } catch (\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

}