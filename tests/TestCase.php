<?php

use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;
use Laracasts\TestDummy\Factory as TestDummy;

class TestCase extends IntegrationTest
{

    use Laracasts\Integrated\Services\Laravel\Application;
    use ApplicationTrait;


    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__ . '/../bootstrap/start.php';

    }

    public function tearDownLaravel()
    {

    }

    protected function verifiedLogin($user = null)
    {

        $user = $user ?: TestDummy::create('User');
        $user->confirmEmail();

        return $this->login($user);
    }

    protected function login($user = null, $password = null)
    {
        $user = $user ?: TestDummy::create('User');
        $password = $password ?: 'password';

        return $this->visit('login')
            ->fill($user->email, 'email')
            ->fill($password, 'password')
            ->press('Login');
    }

    protected function beAuth($user = null)
    {
        $user = $user ?: TestDummy::create('User');
        $user->confirmEmail();

        return $this->be($user);
    }


}
