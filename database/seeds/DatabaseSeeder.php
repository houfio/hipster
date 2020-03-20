<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Artisan::call('migrate:fresh');

        $this->call([
            RolesSeeder::class,
            PeriodsSeeder::class,
            SubjectSeeder::class,
            ExamsSeeder::class,
            TeachersSeeder::class,
            UsersSeeder::class
        ]);
    }
}
