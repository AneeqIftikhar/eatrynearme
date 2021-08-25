<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state_id',
        'country_id',
        'slug',
        'restaurant_count',
        'rapid_api_location_id',
        'location_json_dump'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function restaurants(){
        return $this->hasMany(Restaurants::class);
    }
}

