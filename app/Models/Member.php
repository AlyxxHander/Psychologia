<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'profile_photo',
    'imagekit_file_id',
    'position_id',
    'full_name',
    'email',
    'join_date',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [

  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'join_date' => 'date:Y-m-d',
    ];
  }

  /**
   * Accessor to format join_date as DD/MM/YYYY
   */
  public function getFormattedJoinDateAttribute()
  {
    return $this->join_date ? $this->join_date->format('d/m/Y') : '-';
  }

  public function position()
  {
    return $this->belongsTo(Position::class, 'position_id');
  }
}
