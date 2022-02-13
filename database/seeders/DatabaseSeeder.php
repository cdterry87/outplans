<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\Message;
use App\Models\Plan;
use App\Models\PlanAttendee;
use App\Models\PlanInvite;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create a guest account
        $guest = User::factory()->create([
            'name' => 'Guest Account',
            'email' => 'guest@example.com',
        ]);

        // Create a secondary user
        $user = User::factory()->create([
            'name' => 'User Account',
            'email' => 'user@example.com',
        ]);

        // For the guest account, create some plans
        $guest->plans()->saveMany(Plan::factory()->count(15)->create([
            'user_id' => $guest->id
        ])->each(function ($plan) use (&$guest) {
            // For each plan add some attendees...
            $plan->attendees()->saveMany(PlanAttendee::factory()->count(5)->create([
                'plan_id' => $plan->id
            ]));
            // ...and send some plan invites
            $plan->invites()->saveMany(PlanInvite::factory()->count(5)->create([
                'user_id' => $guest->id,
                'plan_id' => $plan->id
            ]));
            // ...and finally display some messages for each plan
            $guest->messages()->saveMany(Message::factory()->count(2)->create([
                'user_id' => $guest->id,
                'plan_id' => $plan->id
            ]));
        }));

        // The guest should also have some friends
        $guest->friends()->saveMany(Friend::factory()->count(5)->create([
            'user_id' => $guest->id,
        ]));

        // And the guest should also have sent some friend invites
        $guest->friends_requests()->saveMany(FriendRequest::factory()->count(5)->create([
            'user_id' => $guest->id,
        ]));

        // Create plans in the past for secondary user and add the guest account as an attendee
        $user->plans()->saveMany(Plan::factory()->count(3)->create([
            'user_id' => $user->id,
            'start_datetime' => Carbon::yesterday(),
            'published' => Carbon::yesterday(),
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::yesterday()
        ])->each(function ($plan) use (&$user, &$guest) {
            $plan->attendees()->save(PlanAttendee::factory()->create([
                'status' => 'A',
                'plan_id' => $plan->id,
                'user_id' => $guest->id
            ]));
        }));

        // Create plans in the future for secondary user and send invites to the guest user
        $user->plans()->saveMany(Plan::factory()->count(3)->create([
            'user_id' => $user->id,
            'start_datetime' => Carbon::now()->addYear(),
            'published' => Carbon::yesterday(),
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::yesterday()
        ])->each(function ($plan) use (&$user, &$guest) {
            $plan->invites()->save(PlanInvite::factory()->create([
                'user_id' => $user->id,
                'invited_user_id' => $guest->id,
                'plan_id' => $plan->id
            ]));
        }));

        // The secondary user should have a friend
        $guest->friends()->save(Friend::factory()->create([
            'user_id' => $guest->id,
        ]));

        // And the secondary user should also have sent a friend request to the guest user
        $user->friends_requests()->save(FriendRequest::factory()->create([
            'user_id' => $user->id,
            'requested_user_id' => $guest->id,
        ]));
    }
}
