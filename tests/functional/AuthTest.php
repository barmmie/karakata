<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 6/26/15
 * Time: 8:19 AM
 */


use Laracasts\TestDummy\Factory as TestDummy;

class AuthTest extends TestCase
{
    use DatabaseTransactionTrait;

    /**
     *
     * @test
     */

    public function it_registers_a_user()
    {
        $credentials = ['email' => 'test@example.com'];
        $this->register($credentials)
            ->seeInDatabase('users', $credentials + ['role' => User::USER_ROLE, 'verified' => 0])
            ->seePageIs('/')
            ->see('Registration successful');
    }

    protected function register(array $overrides)
    {

        $fields = TestDummy::attributesFor('User', $overrides);
        $fields['password'] = 'password';
        $fields += ['confirm_password' => $fields['password'], 'terms' => 'on'];

        return $this->visit('/register')
            ->submitForm('Create my account', $fields);

    }

    /**
     * @test
     */

    public function it_doesnt_allow_duplicate_emails()
    {
        $credentials = ['email' => 'test@example.com'];
        $this->register($credentials);

        $this->register($credentials)
            ->see('Email has already been taken');
    }

    /**
     * @test
     */
    public function it_registers_a_user_but_must_confirm_their_email_address()
    {
        $credentials = ['email' => 'test@example.com'];
        $this->register($credentials);

        $user = User::where('email', 'test@example.com')->first();

        $this->login($user)
            ->see('Unverified account')
            ->onPage('/login');

        $this->visit("/register/confirm/{$user->confirmation_token}sasasa")
            ->see('Invalid verification link')
            ->seeInDatabase('users', $credentials + ['role' => User::USER_ROLE, 'verified' => 0]);

        $this->visit("/register/confirm/{$user->confirmation_token}")
            ->see('Verification successful');


        $this->seeInDatabase('users', $credentials + ['role' => User::USER_ROLE]);

    }

    /**
     *
     * @test
     */
    public function a_user_may_login()
    {
        $user = TestDummy::create('User');


        $this->verifiedLogin($user)
            ->see('You are now logged in')
            ->see($user->full_name);
    }

    public function a_user_may_logout()
    {
        $user = TestDummy::create('User');

        $this->verifiedLogin($user)
            ->see('You are now logged in')
            ->see($user->full_name);

        $this->visit('/')
            ->click('Logout')
            ->see('Logged out');

    }


}