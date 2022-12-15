<?php
use Faker\Factory as Faker;
use Laracasts\TestDummy\Factory as TestDummy;


class ProfileTest extends TestCase
{
    use DatabaseTransactionTrait;


    /**
     * @test
     */

    public function it_updates_user_profile()
    {
        $faker = Faker::create();
        $new_credentials = ['full_name' => $faker->name, 'phone' => $faker->phoneNumber];
        $this->verifiedLogin()
            ->visit('/profile')
            ->see('Update profile')
            ->submitForm('Update profile', $new_credentials)
            ->see('Update successful')
            ->seeInDatabase('users', $new_credentials)
            ->onPage('/myitems');
    }


    /**
     * @test
     */

    public function it_updates_user_password()
    {
        $user = TestDummy::create('User');

        $this->verifiedLogin($user)
            ->visit('/profile')
            ->see('Update password')
            ->submitForm('Update password', [
                'current_password' => 'password',
                'new_password' => 'password2',
                'confirm_new_password' => 'password2'
            ])
            ->see('Password update successful')
            ->onPage('/myitems')
            ->visit('/logout')
            ->login($user)
            ->see('Authentication error')
            ->login($user, 'password2')
            ->see('You are now logged in');
    }

}