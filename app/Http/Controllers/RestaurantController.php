<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityListingJson;
use App\Models\Country;
use App\Models\Restaurants;
use App\Models\Review;
use App\Models\State;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function downloadImage()
    {

//        dd($ch);
        $data = Restaurants::where('image_tripadvisor', '!=', null)->where('image', null)->limit(5)->get();
//        dd($data->count());
        if ($data->count() > 0) {

            foreach ($data as $key => $d) {

                $url[$key] = $d->image_tripadvisor;
                // $destination_folder = asset('restaurantspictures/');
                $path[$key] = '/restaurantspictures/' . time() . '-' . basename($url[$key]);
                $destination_folder[$key] = $_SERVER['DOCUMENT_ROOT'] . $path[$key];

//            file_put_contents($destination_folder[$key], file_get_contents($url[$key]));

                $path[$key] = '/restaurantspictures/' . time() . '-' . basename($url[$key]);
                $ch[$key] = curl_init($url[$key]);
                $fp[$key] = fopen($_SERVER['DOCUMENT_ROOT'] . $path[$key], 'wb');
                curl_setopt($ch[$key], CURLOPT_FILE, $fp[$key]);
                curl_setopt($ch[$key], CURLOPT_HEADER, 0);
                curl_exec($ch[$key]);
                curl_close($ch[$key]);
                fclose($fp[$key]);

                $d->image = $path[$key];
                $d->save();
            }
//            dd($destination_folder);
        }
    }

    public function putData()
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

    public function statesSlug()
    {
        $states = State::all();

        foreach ($states as $key => $s) {
            $slug[$key] = substr(str_replace(' ', '-', strtolower($s->name)), 0, 10);
            $checkSlug[$key] = State::where("slug", $slug[$key])->get();
            // dd($checkSlug[$key]->count()+ 1);
            if ($checkSlug[$key]->count() > 0) {
                $new[$key] = (int)$checkSlug[$key]->count() + 1;
                // dd($slug[$key] . '-' . (string)$new[$key]);
                $s->slug = $slug[$key] . '-' . (string)$new[$key];
            } else {
                $s->slug = $slug[$key];
            }

            $s->save();
        }
    }

    public function restaurant($country = null, $state = null, $city = null, $restaurant = null)
    {

        // dd( $state);
        $stateName = null;
        if (!is_null($country)) {
            $countryGet = Country::where('abv3', $country)->first();
            $statesData = State::where('country_id',$countryGet->id)->where('restaurant_count','>',0)->get();
            $data = $statesData;
            $countryName = $countryGet->name;
        }

        if (!is_null($state)) {
            $stateGet = State::where('abv', $state)->where('country_id',$countryGet->id)->first();
            $CitiesData = City::where('state_id',$stateGet->id)->where('restaurant_count','>',0)->get();
            $data = $CitiesData;
            $stateName = $stateGet->name;
        }

        if (!is_null($city)) {
            // dd($city);
            $citiesGet = City::where('slug', $city)->where('state_id',$stateGet->id)->first();
            $data = Restaurants::where('is_deleted',0)->where('city_id', $citiesGet->id)->get();
        }

        if (!is_null($restaurant)) {
            $getRes = Restaurants::where('slug', $restaurant)->where('is_deleted',0)->where('city_id', $citiesGet->id)->first();
//            dd($getRes->city()->restaurants->limit(10)->get());
            $related = Restaurants::where('city_id', $getRes->city->id)->where('is_deleted',0)->where('id','!=', $getRes->id)->limit(5)->get();

            return view('single-restaurant', compact('data', 'country', 'state', 'city', 'countryName', 'stateName', 'getRes','related'));
            // dd($restaurant);
        }


        return view('states-cities', compact('data', 'country', 'state', 'city', 'countryName', 'stateName'));
    }

    public function getreviews()
    {
        $rests = Restaurants::where('is_reviewed', 0)->limit(5)->get();

        foreach ($rests as $key=>$r) {
            $curl[$key] = curl_init();

            curl_setopt_array($curl[$key], [
                CURLOPT_URL => "https://worldwide-restaurants.p.rapidapi.com/reviews",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "location_id=$r->location_id&language=en_US&limit=15&currency=USD",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: worldwide-restaurants.p.rapidapi.com",
                    "X-RapidAPI-Key: b236268ba6msh984ca2b116a0197p160c4ejsnac37cb65c3bf",
                    "content-type: application/x-www-form-urlencoded"
                ],
            ]);

            $response[$key] = curl_exec($curl[$key]);
            $err[$key] = curl_error($curl[$key]);

            curl_close($curl[$key]);

            if ($err[$key]) {
                echo "cURL Error #:" . $err[$key];
            } else {
             $data[$key] = json_decode($response[$key], 1);
             $data[$key] = serialize($response[$key]);

             Review::create([
                 'restaurant_id' => $r->id,
                  'json_data' => $data[$key]
             ]);

                $r->is_reviewed = 1;
                $r->save();
            }
        }
    }

    public function addCityRestaurantCount()
    {
         $cities = City::whereNotNull('location_json_dump')->get();
         for($i = 0; $i<count($cities);$i++){
           $count = Restaurants::where('city_id', $cities[$i]->id)->where('is_deleted',0)->count();
           $cities[$i]->restaurant_count = $count;
           $cities[$i]->save();
         }
         $states = State::all();
         for($i = 0; $i<count($states);$i++){
           $count = $states[$i]->cities->sum('restaurant_count');
           $states[$i]->restaurant_count = $count;
           $states[$i]->save();
         }
    }

}
