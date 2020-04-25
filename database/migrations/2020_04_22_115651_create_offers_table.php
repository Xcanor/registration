<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('rooms');
            $table->boolean('status')->default(1);
            $table->float('agency_price');
            $table->float('user_price');
            $table->timestamps();
    
            $table->foreign('agency_id')
                ->references('id')
                ->on('agencies')
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
        Schema::dropIfExists('offers');
    }
}
