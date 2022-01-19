<?php

namespace Database\Seeders;

use App\Models\PlanInvite;
use Illuminate\Database\Seeder;

class PlanInviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanInvite::factory(10)->create();
    }
}
