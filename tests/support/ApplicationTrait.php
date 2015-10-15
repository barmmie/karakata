<?php


//use Mockery;
use Illuminate\Auth\UserInterface as UserContract;

trait ApplicationTrait
{
    /**
     * The Illuminate application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The last code returned by Artisan CLI.
     *
     * @var int
     */
    protected $code;

    /**
     * Specify a list of events that should be fired for the given operation.
     *
     * These events will be mocked, so that handlers will not actually be executed.
     *
     * @param  array|dynamic $events
     * @return $this
     */
    public function expectsEvents($events)
    {
        $events = is_array($events) ? $events : func_get_args();

        $mock = Mockery::spy('Illuminate\Events\Dispatcher');

        $mock->shouldReceive('fire')->andReturnUsing(function ($called) use (&$events) {
            foreach ($events as $key => $event) {
                if ((is_string($called) && $called === $event) ||
                    (is_string($called) && is_subclass_of($called, $event)) ||
                    (is_object($called) && $called instanceof $event)
                ) {
                    unset($events[$key]);
                }
            }
        });

        $this->beforeApplicationDestroyed(function () use (&$events) {
            if ($events) {
                throw new Exception(
                    'The following events were not fired: [' . implode(', ', $events) . ']'
                );
            }
        });

        $this->app->instance('events', $mock);

        return $this;
    }

    /**
     * Set the session to the given array.
     *
     * @param  array $data
     * @return $this
     */
    public function withSession(array $data)
    {
        $this->session($data);

        return $this;
    }

    /**
     * Set the session to the given array.
     *
     * @param  array $data
     * @return void
     */
    public function session(array $data)
    {
        $this->startSession();

        foreach ($data as $key => $value) {
            $this->app['session']->put($key, $value);
        }
    }

    /**
     * Start the session for the application.
     *
     * @return void
     */
    protected function startSession()
    {
        if (!$this->app['session']->isStarted()) {
            $this->app['session']->start();
        }
    }

    /**
     * Flush all of the current session data.
     *
     * @return void
     */
    public function flushSession()
    {
        $this->startSession();

        $this->app['session']->flush();
    }

    /**
     * Set the currently logged in user for the application.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  string|null $driver
     * @return $this
     */
    public function actingAs(UserContract $user, $driver = null)
    {
        $this->be($user, $driver);

        return $this;
    }

    /**
     * Set the currently logged in user for the application.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  string|null $driver
     * @return void
     */
    public function be(UserContract $user, $driver = null)
    {
        $this->app['auth']->driver($driver)->setUser($user);
    }

    /**
     * Assert that a given where condition exists in the database.
     *
     * @param  string $table
     * @param  array $data
     * @param  string $connection
     * @return $this
     */
    public function seeInDatabase($table, array $data, $connection = null)
    {
        $database = $this->app->make('db');

        $connection = $connection ?: $database->getDefaultConnection();

        $count = $database->connection($connection)->table($table)->where($data)->count();

        $this->assertGreaterThan(0, $count, sprintf(
            'Unable to find row in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }

    /**
     * Assert that a given where condition does not exist in the database.
     *
     * @param  string $table
     * @param  array $data
     * @param  string $connection
     * @return $this
     */
    public function missingFromDatabase($table, array $data, $connection = null)
    {
        return $this->notSeeInDatabase($table, $data, $connection);
    }

    /**
     * Assert that a given where condition does not exist in the database.
     *
     * @param  string $table
     * @param  array $data
     * @param  string $connection
     * @return $this
     */
    public function notSeeInDatabase($table, array $data, $connection = null)
    {
        $database = $this->app->make('db');

        $connection = $connection ?: $database->getDefaultConnection();

        $count = $database->connection($connection)->table($table)->where($data)->count();

        $this->assertEquals(0, $count, sprintf(
            'Found unexpected records in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }

    /**
     * Seed a given database connection.
     *
     * @param  string $class
     * @return void
     */
    public function seed($class = 'DatabaseSeeder')
    {
        $this->artisan('db:seed', ['--class' => $class]);
    }

    /**
     * Call artisan command and return code.
     *
     * @param string $command
     * @param array $parameters
     * @return int
     */
    public function artisan($command, $parameters = [])
    {
        return $this->code = $this->app['Illuminate\Console\Application']->call($command, $parameters);
    }

    /**
     * Register an instance of an object in the container.
     *
     * @param  string $abstract
     * @param  object $instance
     * @return object
     */
    protected function instance($abstract, $instance)
    {
        $this->app->instance($abstract, $instance);

        return $instance;
    }

    /**
     * Mock the event dispatcher so all events are silenced.
     *
     * @return $this
     */
    protected function withoutEvents()
    {
        $mock = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');

        $mock->shouldReceive('fire');

        $this->app->instance('events', $mock);

        return $this;
    }
}
