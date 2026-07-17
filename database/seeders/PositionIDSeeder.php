<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionIDSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed to add default Hardcoded Admin Accounts
   */
  public function run(): void
  {
    $members = Member::all();

    foreach ($members as $member) {
      $position = Position::where('position', $member->position)->first();
      if ($position) {
        $member->position_id = $position->id;
        $member->save();
      }
    }
  }
}
