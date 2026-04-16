<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TodoFactory extends Factory
{
    protected $model = Todo::class;
    
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'is_completed' => fake()->boolean(),
            'user_id' => User::factory(),
        ];
    }
}