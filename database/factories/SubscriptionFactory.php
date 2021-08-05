<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function() {
                // return Subscription::factory(User::class)->create()->id;
                return User::factory()->create()->id;
            },
            'channel_id' => function() {
                return Channel::factory()->create()->id;
            }
        ];
    }
}
