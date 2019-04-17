<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('type');
            $table->text('salutation');
            $table->string('name');
            $table->text('address')->nullable();
            $table->biginteger('pincode');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->unique()->nullable();
            $table->biginteger('landline')->nullable();
            $table->biginteger('mobile')->unique()->nullable();
            $table->date('dob')->nullable();
            $table->string('pan',10)->nullable();
            $table->text('remarks')->nullable();
            $table->text('updates')->nullable();
            $table->text('user')->nullable();
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
        Schema::dropIfExists('donors');
    }
}
