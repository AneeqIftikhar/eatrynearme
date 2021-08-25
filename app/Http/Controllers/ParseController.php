<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\CurlApi;
use App\Models\City;
use App\Models\CityListingJson;
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
}
