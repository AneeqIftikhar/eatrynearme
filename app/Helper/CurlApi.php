<?php
namespace App\Helper;

class CurlApi
{
    /*
        Get Images From Restaurant Globe API Curl Request
    */
    public static function getGlobeImage($state,$city,$restaurant)
    {
        $curl = curl_init();
        $url = "http://restaurantsglobe.com/api/getImages/".$state."/".$city."/".$restaurant;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;

    }
    /*
        Get Location Id From Rapid API Curl Request
        It searches for the City from Name and returns the Id
        That Id will be used to make a new request to get restaurants
    */
    public static function getLocationId($name)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://worldwide-restaurants.p.rapidapi.com/typeahead",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "q=".$name."&language=en_US",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: worldwide-restaurants.p.rapidapi.com",
                "X-RapidAPI-Key: b236268ba6msh984ca2b116a0197p160c4ejsnac37cb65c3bf",
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;

    }
    /*
        Get Search Results Rapid API
        It searches for restaurants based on the location id
        Expects Location Id and Offset
        By default api returns 50 resualts at max
    */
    public static function getSearchResult($locationId,$offset=0)
    {
        $curl = curl_init();
        $key_array=array("X-RapidAPI-Key: 5d2ef7e115msh5bc06a8bc2edb61p1c27d3jsn4d0c54b8d403","X-RapidAPI-Key: 563cdf46b2msh6781a5cf53add49p1f9192jsne6745b6f273a");

        $key = array_rand($key_array);
        if($offset==0)
        {
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://worldwide-restaurants.p.rapidapi.com/search",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "language=en_US&limit=50&location_id=".$locationId."&currency=USD",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: worldwide-restaurants.p.rapidapi.com",
                    $key_array[$key],
                    "content-type: application/x-www-form-urlencoded"
                ],
            ]);
        }
        else
        {
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://worldwide-restaurants.p.rapidapi.com/search",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "offset=".$offset."&language=en_US&limit=50&location_id=".$locationId."&currency=USD",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: worldwide-restaurants.p.rapidapi.com",
                    $key_array[$key],
                    "content-type: application/x-www-form-urlencoded"
                ],
            ]);
        }


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;

    }
    /*
        reading a csv file and turning into an array helper function
    */
    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}

