<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityListingJson;
use App\Models\Country;
use App\Models\Restaurants;
use App\Models\Review;
use App\Models\State;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function googleIndexing(Request $request)
    {
    	$client = new \Google_Client();

		// service_account_file.json is the private key that you created for your service account.
		$client->setAuthConfig('/home/eatrynearme/public_html/eatry-instant-indexing-467b0e8faf5b.json');
		$client->addScope('https://www.googleapis.com/auth/indexing');

		// Get a Guzzle HTTP Client
		$httpClient = $client->authorize();
		$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

		// Define contents here. The structure of the content is described in the next step.
    	$listings=Restaurants::where('google_api_count',0)->with('city','city.state','city.state.country')->take(50)->get();
    	
    	for($i=0;$i<count($listings);$i++)
    	{
    	    $listing = $listings[$i];
    	    $url='https://eatrynearme.com/'.strtolower($listing->city->state->country->abv3).'/'.strtolower($listing->city->state->abv).'/'.$listing->city->slug.'/'.$listing->slug;
    		$content = '{
      			"url": "'.$url.'",
      			"type": "URL_UPDATED"
    		}';
    
    		$response = $httpClient->post($endpoint, [ 'body' => $content ]);
    		$status_code = $response->getStatusCode();
    		if($status_code==200 || $status_code==201)
    		{
    		    $listing->google_api_count=1;
        	    $listing->save();
    		}
        	
    	}
    
    
    }

    public function city($page=0)
    {
        $url_count=20000;
        if($page==0)
        {
            $cities = City::whereNotNull('location_json_dump')->where('restaurant_count','>',0)->take($url_count)->get();
        }     
        else
        {
            $skip = $page*$url_count;
            $cities = City::whereNotNull('location_json_dump')->where('restaurant_count','>',0)->skip($skip)->take($url_count)->get();
        }
        
        return response()->view('sitemaps.city', compact('cities'))->header('Content-Type','text/xml');
    }
    public function state($page=0)
    {
        $url_count=20000;
        if($page==0)
        {
            $states = State::with('country')->where('restaurant_count','>',0)->take($url_count)->get();
        }     
        else
        {
            $skip = $page*$url_count;
            $states = State::with('country')->where('restaurant_count','>',0)->skip($skip)->take($url_count)->get();
        }
        
        return response()->view('sitemaps.state', compact('states'))->header('Content-Type','text/xml');
    }
    public function restaurant($page=0)
    {
        $url_count=20000;
        if($page==0)
        {
            $restaurants=Restaurants::with('city','city.state','city.state.country')->take($url_count)->get();
        }     
        else
        {
            $skip = $page*$url_count;
            $restaurants=Restaurants::with('city','city.state','city.state.country')->skip($skip)->take($url_count)->get();
        }

        return response()->view('sitemaps.restaurant', compact('restaurants'))->header('Content-Type','text/xml');
    }
}