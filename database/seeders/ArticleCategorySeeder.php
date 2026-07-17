<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed to add default Hardcoded Admin Accounts
   */
  public function run(): void
  {
    ArticleCategory::truncate();
    // List of Accounts
    $categoryList = [
      'Clinical Psychology',
      'Cognitive Psychology',
      'Developmental Psychology',
      'Educational Psychology',
      'Social Psychology',
      'Industrial & Organizational Psychology',
      'Personality Psychology',
      'Health Psychology',
      'Counseling Psychology',
      'Forensic Psychology',
      'Neuropsychology',
      'Positive Psychology',
      'Sport Psychology',
      'Psychological Assessment',
      'Mental Health'
    ];

    // Create Position
    foreach($categoryList as $category) {
      ArticleCategory::create([
        'category' => $category,
      ]);
    }
  }
}
