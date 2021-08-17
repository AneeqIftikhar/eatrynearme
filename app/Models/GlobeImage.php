<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GlobeImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title',
        'alt',
        'restaurant_id'
    ];


}
