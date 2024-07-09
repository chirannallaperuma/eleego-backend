<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbdbVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbdb_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('name');
            $table->string('transmission');
            $table->string('fuel_type');
            $table->integer('capacity');
            $table->integer('seats');
            $table->integer('doors');
            $table->integer('luggages');
            $table->string('availability');
            $table->string('category');
            $table->string('image_path')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_disk')->nullable();
            $table->dateTime('last_booking_pickup_date')->nullable();
            $table->dateTime('last_booking_drop_date')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tbdb_vehicles');
    }
}
