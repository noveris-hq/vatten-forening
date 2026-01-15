<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'content', 'date', 'is_important'];

    protected $casts = [
        'date' => 'date',
        'is_important' => 'boolean',
    ];
}
