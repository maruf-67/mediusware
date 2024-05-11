<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $individualUser = User::where('account_type', 'Individual')->first();

        // Get Business user
        $businessUser = User::where('account_type', 'Business')->first();

        // Sample transactions for Individual user
        Transaction::create([
            'user_id' => $individualUser->id,
            'transaction_type' => 'withdrawal',
            'amount' => 1000,
            'fee' => 0,
            'date' => now(),
        ]);

        Transaction::create([
            'user_id' => $individualUser->id,
            'transaction_type' => 'withdrawal',
            'amount' => 4000,
            'fee' => 60, // Fee calculated manually (0.015% of 4000)
            'date' => now(),
        ]);

        Transaction::create([
            'user_id' => $individualUser->id,
            'transaction_type' => 'withdrawal',
            'amount' => 2000,
            'fee' => 0,
            'date' => now(),
        ]);

        // Sample transactions for Business user
        Transaction::create([
            'user_id' => $businessUser->id,
            'transaction_type' => 'withdrawal',
            'amount' => 1000,
            'fee' => 25, // Fee calculated manually (0.025% of 1000)
            'date' => now(),
        ]);

        Transaction::create([
            'user_id' => $businessUser->id,
            'transaction_type' => 'withdrawal',
            'amount' => 5000,
            'fee' => 0,
            'date' => now(),
        ]);

    }
}
