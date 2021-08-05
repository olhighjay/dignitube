<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Channel;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::factory()->create([
            'email'=> 'john@doe.com'
        ]);

        $user2 = User::factory()->create([
            'email'=> 'jane@doe.com'
        ]);


        $channel1 = Channel::factory()->create([
            'user_id'=> $user1->id
        ]);

        $channel2 = Channel::factory()->create([
            'user_id'=> $user2->id
        ]);


        $channel1->subscriptions()->create([
            'user_id'=> $user2->id
        ]);

        $channel2->subscriptions()->create([
            'user_id'=> $user1->id
        ]);


        Subscription::factory(10)->create([
            'channel_id'=> $channel1->id
        ]);

        Subscription::factory(10)->create([
            'channel_id'=> $channel2->id
        ]);
        
    }
}
