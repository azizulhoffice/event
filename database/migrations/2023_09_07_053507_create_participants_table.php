<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no');
            $table->string('name_en')->nullable();
            $table->string('name_bn')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('class')->nullable();
            $table->string('inst_name')->nullable()->comment('Institute Name');
            $table->string('inst_address')->nullable()->comment('Institute Address');
            $table->string('dob')->nullable()->comment('Date of Birth');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('rank')->nullable();
            $table->decimal('total_earn_score',3,2)->nullable();
            $table->decimal('avg_score',3,2)->nullable();
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
        Schema::dropIfExists('participants');
    }
}
