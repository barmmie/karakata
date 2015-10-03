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

            $result = ['success' => false, 'message' => 'Invalid credentials check and try again'];

            return $result;
        }

        if (\Hash::check($command->password, $user->password)) {

            if (!$user->isVerified()) {
                $result = [
                    'success' => false,
                    'message' => 'Unverified account. Check the email or resend confirmation email'
                ];

                return $result;
            }

            if ($user->isBanned()) {
                $result = ['success' => false, 'message' => 'You are banned from logged in'];

                return $result;
            }

            \Auth::login($user);
            $result = ['success' => true, 'message' => 'You are now logged in'];

        } else {
            $result = ['success' => false, 'message' => 'Invalid credentials check and try again'];

        }

        return $result;
    }

}