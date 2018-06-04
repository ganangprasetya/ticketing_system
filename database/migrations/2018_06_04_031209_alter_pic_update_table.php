<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPicUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_complaints', function (Blueprint $table) {
            $table->integer('pic_update_2')->unsigned()->after('pic_update')->default(0);
            $table->integer('pic_update_3')->unsigned()->after('pic_update_2')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_complaints', function (Blueprint $table) {
            $table->dropColumn('pic_update_2');
            $table->dropColumn('pic_update_3');
        });
    }
}
