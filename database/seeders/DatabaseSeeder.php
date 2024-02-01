<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->delete();
        $userIds = [];

        for ($i = 1; $i <= 3; $i++) {
            $id = fake()->uuid();
            $userIds[] = $id;
            if ($i == 1) {
                User::factory()->create([
                    'id' => $id,
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'avatarUrl' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->numberBetween(1, 1000),
                    'password' => 'admin',
                ]);
            } else {
                User::factory()->create([
                    'id' => $id,
                    'avatarUrl' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . fake()->numberBetween(1, 1000),
                ]);
            }
        }


        Transaction::query()->delete();
        for ($i = 1; $i <= 10; $i++) {
            Transaction::create([
                'user_id' => fake()->randomElement($userIds),
                'amount' => fake()->numberBetween(10000, 100000),
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                'type' => fake()->randomElement(['withdraw', 'deposit'])
            ]);
        }
    }
}
