<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'website_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
