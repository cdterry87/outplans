<?php

namespace Database\Factories;

use App\Models\PlanInvite;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanInviteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlanInvite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'invited_user_id' => User::factory(1)->create()->first(),
            'plan_id' => 1
        ];
    }
}
