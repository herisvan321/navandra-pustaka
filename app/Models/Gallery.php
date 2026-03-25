<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'title',
        'type', // 'gallery' or 'documentation'
        'image_path',
        'description',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
