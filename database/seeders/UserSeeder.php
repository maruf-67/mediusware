<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an Individual user
        User::create([
            'name' => 'New User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'account_type' => 'Individual',
            'balance' => 5000, // Sample balance
        ]);

        // Create a Business user
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'account_type' => 'Business',
            'balance' => 10000, // Sample balance
        ]);

    }
}
