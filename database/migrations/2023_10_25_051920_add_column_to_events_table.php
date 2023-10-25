<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {

            $table->integer("group_id")->unsigned()->nullable()->after("occation")->references("id")->on("groups");

            $table->integer("category_id")->unsigned()->nullable()->after("group_id")->references("id")->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id','group_id']);
        });
    }
}
