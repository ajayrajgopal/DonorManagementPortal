<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationPurposeMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_purpose_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->text('purpose');
            $table->timestamps();
        });
        DB::table('donation_purpose_masters')->insert(
            array(
                'purpose' => 'Special Meals'
            )
        );
        DB::table('donation_purpose_masters')->insert(
            array(
                'purpose' => 'General Donation'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_purpose_masters');
    }
}
