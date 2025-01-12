<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupUser>
 */
class GroupUserFactory extends Factory
{
    protected $model = GroupUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_id' => Group::factory(),
            'user_id' => User::factory(),   
            'role' => $this->faker->randomElement(['member', 'admin']), 
            'status' => $this->faker->randomElement(['approved', 'pending']), 
            'created_by' => User::inRandomOrder()->first()->id, 
            'created_at' => now(),  
        ];
    }
}
