<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityListingJsonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_listing_jsons', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(0); // 0 data to be searched // 1 data to be processed // 2 all done
            $table->mediumText('json_dump');
            $table->unsignedBigInteger('city_id')->nullable(); 
            $table->foreign('city_id')->references('id')->on('cities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_listing_jsons');
    }
}
