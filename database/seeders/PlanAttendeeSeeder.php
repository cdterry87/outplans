<?php

namespace Database\Seeders;

use App\Models\PlanAttendee;
use Illuminate\Database\Seeder;

class PlanAttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanAttendee::factory(10)->create();
    }
}
