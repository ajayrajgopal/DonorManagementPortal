<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSubTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_sub_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eventid');
            $table->string('subevent');
            $table->timestamps();
        });
        DB::table('event_sub_types')->insert(
            array(
                'eventid' => 1,
                'subevent' => 'Breakfast'
            )
        );
        DB::table('event_sub_types')->insert(
            array(
                'eventid' => 1,
                'subevent' => 'Lunch'
            )
        );
        DB::table('event_sub_types')->insert(
            array(
                'eventid' => 1,
                'subevent' => 'Dinner'
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
        Schema::dropIfExists('event_sub_types');
    }
}
