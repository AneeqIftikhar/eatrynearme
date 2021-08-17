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
    public function globeImage(){
        return $this->hasMany(GlobeImage::class, 'restaurant_id');
    }
    /**
     * Get the restaurants's hours as json.
     *
     * @param  string  $value
     * @return json
     */
    public function getHoursAttribute($value)
    {
        return json_decode($value);
    }

}
