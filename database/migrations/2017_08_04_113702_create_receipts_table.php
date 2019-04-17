<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section',6);
            $table->string('repno',30);
            $table->string('fy',5);
            $table->integer('amount');
            $table->text('paymode');
            $table->date('date');
            $table->integer('cno')->nullable();
            $table->date('cdate')->nullable();
            $table->text('bank')->nullable();
            $table->integer('donorid');
            $table->text('remarks')->nullable();
            $table->string('status',20)->nullable();
            $table->text('reason')->nullable();
            $table->string('xml',1)->nullable();
            $table->string('user')->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
