<?php

namespace App\Models;

use App\Traits\HasUuid;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<BookFactory> */
    use HasFactory, HasUuid;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'category',
        'description',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
