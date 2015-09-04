<?php namespace Karakata\User\Command;

use Laracasts\Commander\CommandHandler;
use User;
use Auth;
use Hash;

class UpdatePasswordCommandHandler implements CommandHandler {

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

            if(Hash::check($command->current_password, $user->password)) {
                $user->password = Hash::make($command->new_password);
                $user->save();

                $result['success'] = true;
                $result['message'] = 'Password has been updated successfully';
            } else {
                $result['success'] = false;
                $result['message'] = 'The current password you entered doesnt match our records';
            }


        }catch(\Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

}