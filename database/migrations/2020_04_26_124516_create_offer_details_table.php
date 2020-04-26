<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->string('from');
            $table->string('to');
            $table->dateTime('departial_time');
            $table->dateTime('arrival_time');
            $table->integer('ticket_number');
            $table->enum('transportation',array('train','bus'));
            $table->timestamps();


            $table->foreign('offer_id')
            ->references('id')
            ->on('offers')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_details');
    }
}
