<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishingStep extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'title',
        'description',
        'order',
        'icon',
    ];
}
