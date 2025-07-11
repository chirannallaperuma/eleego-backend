<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            'key' => 'default_terms_and_conditions',
            'value' => "Daily Kilometer Allowance: 150 km per day included totaling 300 km for the entire rental period.
            \nTolls, parking fees, and driver meals are to be covered by the client or reimbursed upon presentation of receipts.
            \nA deposit of 30% is required to confirm the booking. The remaining balance should be settled no later than {{settle_date}}. Complimentary cancellation is available until {{cancel_before}}.
            \nAny additional kilometers or hours beyond the agreed limit will be invoiced at the end of the assignment"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
