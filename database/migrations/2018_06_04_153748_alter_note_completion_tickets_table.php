<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNoteCompletionTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_complaints', function (Blueprint $table) {
            $table->text('note_completion')->nullable()->after('pic_update_3');
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
            $table->dropColumn('note_completion');
        });
    }
}
