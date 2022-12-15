<?php namespace Karakata\User\Command;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laracasts\Commander\CommandHandler;

class AuthenticateCommandHandler implements CommandHandler
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
            $user = \User::where('email', $command->email)->firstOrFail();

        } catch (ModelNotFoundException $e) {

            $result = ['success' => false, 'message' => trans('phrases.invalid_credentials')];

            return $result;
        }

        if (\Hash::check($command->password, $user->password)) {

            if (!$user->isVerified()) {
                $result = [
                    'success' => false,
                    'message' => trans('phrases.unverified_account')
                ];

                return $result;
            }

            if ($user->isBanned()) {
                $result = ['success' => false, 'message' => trans('phrases.banned_logged_in') ];

                return $result;
            }

            \Auth::login($user, true);
            $result = ['success' => true, 'message' => trans('phrases.logged_in')];

        } else {
            $result = ['success' => false, 'message' => trans('phrases.invalid_credentials')];

        }

        return $result;
    }

}