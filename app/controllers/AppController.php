<?php

use anlutro\LaravelSettings\JsonSettingStore;

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

        if (Setting::get('is_installed', '0' == '1')) {
            flashInfo('App has already been installed');

            return Redirect::route('pages.homepage');
        }

        $installation_requirements = $this->gatherInstallationRequirements();

        return View::make('installation.create', $installation_requirements);
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

        return compact('db_name', 'db_status', 'php_version_status', 'curl_status', 'conditions_satisfied',
            'mcrypt_status', 'storage_folder_write_status');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Setting::get('is_installed', '0' == '1')) {
            flashInfo(trans('phrases.app_has_been_installed'));

            return Redirect::route('pages.homepage');
        };


        try {
            $seeds = ['SettingTableSeeder', 'CategoryTableSeeder'];

            Event::fire('system.install', ['seeds' => $seeds]);

            $user = User::createAdmin('Super admin', Input::get('email'), Input::get('password'), true);

            \Auth::login($user, true);

            $settings = ['site_name', 'currency', 'site_slogan', 'envato_username', 'envato_purchase_code'];

            foreach ($settings as $setting) {
                Setting::set($setting, Input::get($setting));
            }

            return Redirect::route('admin.dashboard');

        } catch (Exception $e) {
            flashError(trans('phrases.error_occured'), $e->getMessage());

            return Redirect::back();
        }


    }

    public function update()
    {
        Artisan::call('migrate', ['--force' => true]);
        flashInfo('Update successful');
        return Redirect::route('pages.homepage');
    }

    protected function checkInstallation()
    {

    }


}