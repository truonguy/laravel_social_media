<?php

namespace Database\Factories;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    protected $model = Follower::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, 
            'follower_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
