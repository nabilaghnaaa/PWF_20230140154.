<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // 101 user
    $users = User::factory(100)->create();

    $users->push(User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]));

    // 500 todo dengan relasi user
    Todo::factory(500)->create([
        'user_id' => function () use ($users) {
            return $users->random()->id;
        }
    ]);
}
}