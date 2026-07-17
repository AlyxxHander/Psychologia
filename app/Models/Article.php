<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'author_id',
    'category_id',
    'imagekit_file_id',
    'thumbnail_photo',
    'title',
    'content',
    'tags',
    'status',
    'is_pinned',
    'created_at',
    'update_at'
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
      'tags' => 'array',
      'is_pinned' => 'boolean',
      'created_at' => 'date:Y-m-d',
      'updated_at' => 'date:Y-m-d',
    ];
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function category()
  {
    return $this->belongsTo(ArticleCategory::class, 'category_id');
  }
}
