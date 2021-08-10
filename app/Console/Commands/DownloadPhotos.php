<?php

namespace App\Console\Commands;

use App\Models\Restaurants;
use Illuminate\Console\Command;

class DownloadPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloading Photos';

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
        $data = Restaurants::where('image_tripadvisor', '!=', null)->where('is_deleted', 0)->where('image', null)->limit(5)->get();
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

                $fp[$key] = fopen(public_path() . $path[$key], 'wb');
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
}
