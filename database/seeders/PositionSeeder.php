<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed to add default Hardcoded Admin Accounts
   */
  public function run(): void
  {
    Position::truncate();
    // List of Accounts
    $positionList = [
      'Director', 
      'Head ADKES', 'Vice Head ADKES',
      'Head POSDM', 'Vice Head POSDM',
      'Head Keuangan', 'Vice Head Keuangan',
      'Head PKPM', 'Vice Head PKPM',
      'Head LUKER', 'Vice Head LUKER',
      'Head DMD', 'Vice Head DMD',
      'Staff'
    ];

    // Create Position
    foreach($positionList as $position) {
      Position::create([
        'position' => $position,
      ]);
    }
  }
}
