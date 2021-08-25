<?php

namespace App\Console\Commands;

use App\Models\CityListingJson;
use App\Models\Restaurants;
use Illuminate\Console\Command;

class addRestaurants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:restaurants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $data = CityListingJson::where('is_copied', 0)->get();
        foreach ($data as $key => $d) {

            // dd($d);
            $restaurants[$key] = json_decode($d->json_dump, true)['results']['data'];

            foreach ($restaurants[$key] as $resKey => $restaurant) {
                // dd();
                Restaurants::create([
                    'name' => $restaurant['name'],
                    'latitude' => (isset($restaurant['latitude'])) ? $restaurant['latitude'] : null,
                    'longitude' => (isset($restaurant['longitude'])) ? $restaurant['longitude'] : null,
                    'num_reviews' => $restaurant['num_reviews'],
                    'timezone' => $restaurant['timezone'],
                    'location_str' => (isset($restaurant['location_string']) && !is_null($restaurant['location_string'])) ? $restaurant['location_string'] : null,
                    'raw_ranking' => (isset($restaurant['raw_ranking'])) ? $restaurant['raw_ranking'] : null,
                    'ratings' => (isset($restaurant['rating'])) ? $restaurant['rating'] : null,
                    'address' => $restaurant['address'],
                    'address_obj' => (isset($restaurant['address_obj'])) ? json_encode($restaurant['address_obj']) : null,
                    'phone' => (isset($restaurant['phone'])) ? $restaurant['phone'] : null,
                    'city_id' => $d->toArray()['city_id'],
                    'status' => $d->toArray()['status'],
                    'slug' => substr(strtolower($this->clean($restaurant['name'])), 0, 15),
                    'website' => (isset($restaurant['website'])) ? $restaurant['website'] : null,
                    'hours' => (isset($restaurant['hours'])) ? json_encode($restaurant['hours']) : null,
                    'image_tripadvisor' => (isset($restaurant['photo']['images']['original']['url'])) ? $restaurant['photo']['images']['original']['url'] : null,
                    'location_id' => $restaurant['location_id'],
                ]);
            }
            $d->is_copied = 1;
            $d->save();
        }
    }

    public function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
