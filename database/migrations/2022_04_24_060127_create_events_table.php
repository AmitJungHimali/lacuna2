<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->binary('image');
            $table->time('time');
            $table->date('startdate');
            $table->text('location');
            $table->foreignId('eventcategory_id');
            $table->text('keyword');
            $table->date('enddate');
            $table->text('venue');
            $table->text('organizer');
            $table->text('price');
            $table->text('food');
            $table->text('description');
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
        Schema::dropIfExists('events');
    }
};
