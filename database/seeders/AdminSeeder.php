<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed to add default Hardcoded Admin Accounts
   */
  public function run(): void
  {
    // List of Accounts
    User::truncate();

    $users = [
      [
        'position_id' => 1,
        'full_name' => 'Director Account',
        'email' => 'director@gmail.com',
        'password' => Hash::make('password123')
      ],
    ];

    // Create Account
    foreach($users as $user) {
      User::create($user);
    }
  }
}
