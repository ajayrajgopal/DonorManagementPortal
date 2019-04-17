<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paytype');
            $table->string('details');
            $table->timestamps();

        });
        DB::table('paymodes')->insert(
            array(
                'paytype' => 'Cash',
                'details' => 'N'
            )
        );
        DB::table('paymodes')->insert(
            array(
                'paytype' => 'Credit Card',
                'details' => 'Y'
            )
        );
        DB::table('paymodes')->insert(
            array(
                'paytype' => 'Debit Card',
                'details' => 'Y'
            )
        );
        DB::table('paymodes')->insert(
            array(
                'paytype' => 'Cheque',
                'details' => 'Y'
            )
        );
        DB::table('paymodes')->insert(
            array(
                'paytype' => 'E-Transfer',
                'details' => 'Y'
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
        Schema::dropIfExists('paymodes');
        
    }
}
