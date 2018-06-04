<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVarTicketComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_complaints', function (Blueprint $table) {
            $table->text('note')->nullable()->change();
            $table->text('pic_complaint')->nullable()->change();
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
            $table->dropColumn('note');
            $table->dropColumn('pic_complaint');
        });
    }
}
