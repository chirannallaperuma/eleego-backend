<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbdbBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbdb_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_id');
            $table->string('category');
            $table->dateTime('pickup_date_time');
            $table->dateTime('drop_date_time');
            $table->string('service_type');
            $table->text('pickup_address');
            $table->text('drop_address');
            $table->integer('no_of_persons');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('payment_method');
            $table->json('additional_services')->nullable();
            $table->text('additional_information')->nullable();
            $table->string('status')->default('pending');
            $table->integer('total_amount')->nullable();
            $table->integer('child_count')->nullable();
            $table->string('child_ages')->nullable();
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
        Schema::dropIfExists('tbdb_bookings');
    }
}
