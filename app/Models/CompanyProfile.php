<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'name',
        'vision',
        'mission',
        'history',
        'values',
        'address',
        'phone',
        'email',
        'logo_path',
        'instagram_url',
        'facebook_url',
        'twitter_url',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
        'mission' => 'array',
        'values' => 'array',
    ];
}
