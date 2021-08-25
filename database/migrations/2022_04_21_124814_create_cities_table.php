<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('slug', 128)->nullable();
            $table->string('rapid_api_location_id',128)->nullable();
            $table->text('location_json_dump')->nullable();
            $table->unsignedBigInteger('state_id')->nullable(); 
            $table->integer('restaurant_count')->default(0);
            $table->foreign('state_id')->references('id')->on('states');
            $table->unsignedBigInteger('country_id'); 
            $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('cities');
    }
}
