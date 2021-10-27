<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'website_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
