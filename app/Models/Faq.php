<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\FaqType;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'question',
        'answer',
    ];

    protected $casts = [
        'type' => FaqType::class,
    ];
}
