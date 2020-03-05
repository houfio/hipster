<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Artisan::call('migrate:fresh');

        $this->call([
            PeriodsSeeder::class,
            GroupsSeeder::class,
            TeachersSeeder::class
        ]);
    }
}
