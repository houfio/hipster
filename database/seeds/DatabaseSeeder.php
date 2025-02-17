<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Artisan::call('migrate:fresh');

        $this->call([
            TagsSeeder::class,
            RolesSeeder::class,
            PeriodsSeeder::class,
            SubjectsSeeder::class,
            ExamsSeeder::class,
            TeachersSeeder::class,
            UsersSeeder::class
        ]);
    }
}
