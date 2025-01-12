<?php

namespace Database\Factories;

use App\Models\Reaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'object_id' => 1, // Mặc định, bạn có thể thay đổi trong seeder
            'object_type' => 'post', // Hoặc 'comment'
            'type' => $this->faker->randomElement(['like']),
            'user_id' => \App\Models\User::factory(), // Tạo user ngẫu nhiên
            'created_at' => now(),
        ];
    }
}
