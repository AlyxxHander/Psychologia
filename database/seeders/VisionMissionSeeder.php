<?php

namespace Database\Seeders;

use App\Enums\VisionMissionType;
use App\Models\VisionMission;
use Illuminate\Database\Seeder;

class VisionMissionSeeder extends Seeder
{
  public function run(): void
  {
    VisionMission::truncate();

    // Vision
    VisionMission::create([
      'type' => VisionMissionType::VISION,
      'content' => 'To be a center of excellence in psychological literacy, cultivating empathetic and critical individuals with high mental resilience to navigate future global dynamics.',
    ]);

    // Missions
    $missions = [
      'Facilitating accessible and applicable popular psychology education for all students.',
      'Building interdisciplinary collaboration networks to enrich perspectives on mental well-being.',
      'Developing students\' soft skills and leadership potential through practical activities and programs.',
    ];

    foreach ($missions as $mission) {
      VisionMission::create([
        'type' => VisionMissionType::MISSION,
        'content' => $mission,
      ]);
    }
  }
}