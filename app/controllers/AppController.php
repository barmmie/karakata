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
        Event::fire('system.install');
        $result = $this->olukoForm->save(Input::all());


        if ($result['success']) {
            Event::fire('user.signup', [
                'email' => $result['mailData']['email'],
                'userId' => $result['mailData']['userId'],
                'activationCode' => $result['mailData']['activationCode']
            ]);

            // Success!
            Session::flash('install.success', Input::all());

            return View::make('installers.success')
                ->with('userDetails', Input::all());

        } else {
            Session::flash('error', $result['message']);
            return Redirect::route('installers.create')
                ->withInput()
                ->withErrors($this->olukoForm->errors());
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