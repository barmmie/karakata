<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
        $this->visit('/');
        $this->seeInDatabase('users', ['email' => 'tushutt@yahoo.com']);
	}

}
