<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
  /**
   * Summary of table
   * @var string
   */
  protected $table = 'vision_missions';

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'type',
    'content',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, \App\Enums\VisionMissionType>
   */
  protected function casts(): array
  {
    return [
      'type' => \App\Enums\VisionMissionType::class,
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
  }
}
