<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('participant_id')->unsigned();
            $table->bigInteger('event_id')->unsigned()->nullable();
            $table->decimal('score', 8, 2)->default(0.00);
            $table->boolean('absent')->default(false);
            $table->bigInteger('user_id')->unsigned()->comment('User=>role is judge');
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
        Schema::dropIfExists('scores');
    }
}
