<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WritingEvent extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'title',
        'type',
        'description',
        'deadline',
        'genre',
        'is_active',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];
}
