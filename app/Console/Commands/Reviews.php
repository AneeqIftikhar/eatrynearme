<?php

namespace App\Console\Commands;

use App\Models\Restaurants;
use App\Models\Review;
use Illuminate\Console\Command;

class Reviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:reviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Restaurant reviews';

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
        $rests = Restaurants::where('is_reviewed', 0)->where('is_deleted', 0)->limit(5)->get();

        foreach ($rests as $key => $r) {
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
                    "X-RapidAPI-Key: 2bc7d2e04fmshdbc5798c804c094p10784cjsn47e68e396a8f",
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
}
