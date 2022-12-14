<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\CurlApi;
use App\Models\City;
use App\Models\CityListingJson;
use App\Models\Restaurants;
use App\Models\GlobeImage;
class ParseController extends Controller
{
    public function getData(Request $request)
    {
        $city = City::where('rapid_api_location_id',NULL)->first();
        $state = $city->state;
        $response = json_decode(CurlApi::getLocationId($city->name." ".$city->state->name),1);
        print_r($response);
        if(isset($response) && isset($response['results']) && count($response['results']['data'])>0)
        {
            $city->location_json_dump=$response['results']['data'][0];
            $city->rapid_api_location_id=$response['results']['data'][0]['result_object']['location_id'];
            $city->save();
            $response2 = CurlApi::getSearchResult($response['results']['data'][0]['result_object']['location_id'],0);
            $check_response2 = json_decode($response2,1);
            if(isset($check_response2) && isset($check_response2['results']) && count($check_response2['results']['data'])>0)
            {
                CityListingJson::create([
                    'json_dump'=>$response2,
                    'status'=>1,
                    'city_id'=>$city->id
                ]);
                if(count($check_response2['results']['data'])==50)
                {
                    $response3 = CurlApi::getSearchResult($response['results']['data'][0]['result_object']['location_id'],50);

                    CityListingJson::create([
                        'json_dump'=>$response3,
                        'status'=>1,
                        'city_id'=>$city->id
                    ]);
                }

            }
            else
            {
                $city->null;
                $city->null;
                $city->save();
                echo "Failed";
            }

        }
        else
        {
            echo "City Not found";
        }



    }
    public function addImages(Request $request){
        $restaurants = Restaurants::where('is_image_added',0)->where('is_deleted',0)->take(100)->get();
        foreach ($restaurants as $restaurant)
        {
            if($restaurant)
            {
                $city = $restaurant->city;
                $state = $city->state;
                $response = CurlApi::getGlobeImage(strtolower($state->abv),$city->slug,$restaurant->slug);
                if($response && $response!='false')
                {

                    $response = json_decode($response,1);
                    for($i = 0; $i< count($response['images']); $i++)
                    {
                        GlobeImage::create([
                            'url'=>"https://restaurantsglobe.com/menus/".$response['images'][$i]['url'],
                            'title'=>$restaurant->name.' - '. $city->name . ' - '. $state->name . ' - Menu | Eatry Near Me',
                            'alt'=>$restaurant->name.' - '. $city->name . ' - '. $state->name . ' - Menu | Eatry Near Me',
                            'restaurant_id'=>$restaurant->id
                        ]);
                    }
                    if(count($response['images'])>0)
                    {
                        $restaurant->is_image_added = count($response['images']);
                    }
                    else
                    {
                        $restaurant->is_image_added = 1;
                    }

                    $restaurant->save();
                }
                else
                {
                    return response()->json([],500);
                }

            }
        }


    }
    public function isDeleted(Request $request)
    {
        $restaurants = Restaurants::where('is_deleted_checked',0)->with('city')->take(1000)->get();
        foreach ($restaurants as $restaurant)
        {
            if(!str_contains($restaurant->location_str, $restaurant->city->name))
            {
                $restaurant->is_deleted=true;
            }
            $restaurant->is_deleted_checked=true;
            $restaurant->save();
        }
    }
}
