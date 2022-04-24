<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->binary('banner');
            $table->char('title',100);
            $table->string('descriptionTitle');
            $table->string('description');
            $table->string('objectivesTitle');
            $table->string('objectiveDescription');
            $table->unsignedInteger('rank');
            $table->boolean('status');
            $table->string('benefitTitle');
            $table->string('benefitDescription');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
