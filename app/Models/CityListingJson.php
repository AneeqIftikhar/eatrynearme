<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   CityListingJson extends Model
{
    use HasFactory;
    protected $fillable = [
        'json_dump',
        'status',
        'city_id'
    ];
    public function city(){
        return $this->belongsTo(City::class);
    }
}
