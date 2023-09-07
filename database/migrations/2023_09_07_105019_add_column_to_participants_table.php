<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->string('serial_no')->after('id');
            $table->string('name_en')->after('id')->nullable();
            $table->string('name_bn')->after('name_en')->nullable();
            $table->unsignedBigInteger('event_id')->after('name_bn')->nullable();
            $table->string('class')->after('event_id')->nullable();
            $table->string('inst_name')->after('class')->nullable();
            $table->string('inst_address')->after('inst_name')->nullable();
            $table->string('dob')->after('inst_address')->nullable()->comment('Date of Birth');
            $table->string('email')->after('dob')->nullable();
            $table->string('rank')->after('email')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pariticipants', function (Blueprint $table) {
            $table->dropColumn(['serial_no','name_en','name_bn','event_id','class','inst_name','inst_address','dob','email','rank']);
        });
    }
}
