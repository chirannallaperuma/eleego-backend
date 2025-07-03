<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_no');
            $table->date('quotation_date');
            $table->string('client_name');
            $table->text('organization');
            $table->text('address');
            $table->date('start_date');
            $table->date('end_date');
            $table->json('vehicle_type');
             $table->decimal('rate_per_day', 10, 2)->nullable();
            $table->integer('days');
            $table->decimal('total_amount', 10, 2);
            $table->date('cancel_before');
            $table->string('contact_person');
            $table->string('contact_number');
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
        Schema::dropIfExists('quotations');
    }
}
