<?php

use App\Period;
use Illuminate\Database\Seeder;

class PeriodsSeeder extends Seeder
{
    public function run()
    {
        factory(Period::class, 16)->create();
    }
}
