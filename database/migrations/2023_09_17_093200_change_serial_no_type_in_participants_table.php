<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeSerialNoTypeInParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE participants MODIFY serial_no INTEGER');
        // Schema::table('participants', function (Blueprint $table) {
        //     $table->bigInteger("serial_no")->nullable()->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement('ALTER TABLE participants MODIFY serial_no VARCHAR(191)');
        // Schema::table('participants', function (Blueprint $table) {
        //     $table->string("serial_no")->change();
        // });
    }
}
