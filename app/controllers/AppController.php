<?php

use \anlutro\LaravelSettings\JsonSettingStore;
use Illuminate\Filesystem\Filesystem;

class AppController extends \BaseController
{
    protected $settingStore;
    protected $fileSystem;

    public function __construct()
    {
        $this->fileSystem = new Filesystem;
        $this->settingStore = new JsonSettingStore($this->fileSystem, storage_path() . '/installation.json');
    }

    public function install()
    {
        $installation_requirements = $this->getInstallationRequirements();

        return View::make('installation.create', $installation_requirements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {

            Event::fire('system.install');

            $user = User::createAdmin('Super admin', Input::get('email'), Input::get('password'), true);
            Auth::login($user);

            $settings = ['site_name', 'currency', 'site_slogan'];

            foreach($settings as $setting)
            {
                Setting::set($setting,  Input::get($setting));
            }

            return Response::json(['success' => 'Logged in successfully'], 200);

        } catch(Exception $e) {
            return Response::json(['error' => $e->getMessage()], 400);
        }


    }

    protected function getInstallationRequirements()
    {
        $default_database = Config::get('database.default');
        $db_name = Config::get("database.connections.{$default_database}.database");

        try {

            $connection = mysqli_connect(Config::get("database.connections.{$default_database}.host"),
                Config::get("database.connections.{$default_database}.username"),
                Config::get("database.connections.{$default_database}.password")
            );

            $database = mysqli_select_db($connection, $db_name);


            $db_status = (boolean)$database;

        } catch (ErrorException $exception) {
            $db_status = false;
        }

        $php_version_status = !(phpversion() < 5.4);

        $curl_status = extension_loaded('curl');
        $mcrypt_status = extension_loaded('bcyrpt');

        $storage_folder_write_status = $this->fileSystem->isWritable(storage_path());

        $conditions_satisfied = $db_status && $php_version_status && $curl_status && $storage_folder_write_status;

        return compact('db_name', 'db_status', 'php_version_status', 'curl_status', 'conditions_satisfied', 'mcrypt_status', 'storage_folder_write_status');
    }


}