<?php namespace Karakata\User\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class RegisterUserCommandHandler implements CommandHandler {

    use DispatchableTrait;
    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        $user = \User::register($command->full_name, $command->email , $command->password, $command->phone );
        $this->dispatchEventsFor($user);

        return $user;
    }

}