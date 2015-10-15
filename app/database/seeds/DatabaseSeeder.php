<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('SettingTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('LocationsTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('ItemSeederTableSeeder');
        $this->call('MessagesTableSeeder');
        $this->call('ReportsTableSeeder');
    }

}
