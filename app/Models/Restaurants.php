<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'num_reviews',
        'timezone',
        'location_str',
        'raw_ranking',
        'ratings',
        'address',
        'address_obj',
        'phone',
        'city_id',
        'status',
        'slug',
        'website',
        'hours',
        'image_tripadvisor',
        'image',
        'location_id',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function reviews(){
        return $this->hasOne(Review::class, 'restaurant_id');
    }
}
