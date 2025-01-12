<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'user_id' => User::inRandomOrder()->first()->id, 
            'auto_approval' => true, 
            'about' => $this->faker->text(),
            'cover_path' => null, 
            'thumbnail_path' => null, 
        ];
    }
}
