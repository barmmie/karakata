<?php

use \anlutro\LaravelSettings\JsonSettingStore;
use Illuminate\Filesystem\Filesystem;

class AppController extends \BaseController
{
    protected $installStore;
    protected $fileSystem;

    public function __construct()
    {
        $fileSystem = App::make('files');

        $this->fileSystem = $fileSystem;

        $this->installStore = new JsonSettingStore($fileSystem, storage_path() . '/installation.json');
    }

    public function install()
    {
        $this->checkInstallation();
        $installation_requirements = $this->gatherInstallationRequirements();

        return View::make('installation.create', $installation_requirements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->checkInstallation();


        try {
            $seeds = ['SettingTableSeeder','CategoryTableSeeder'];

            Event::fire('system.install', ['seeds' => $seeds]);

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

    protected function gatherInstallationRequirements()
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

    protected function checkInstallation()
    {
        if($this->installStore->get('is_installed')){
            flashInfo('App has already been installed');
            return Redirect::route('pages.homepage');
        }
    }


}