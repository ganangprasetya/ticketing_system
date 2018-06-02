<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id')->nullable();
            $table->integer('company_id')->unsigned();
            $table->string('pic_complaint',100)->nullable();
            $table->dateTime('date_complaint')->nullable();
            $table->string('note',255)->nullable();
            $table->integer('user_id')->unsigned();
            $table->boolean('status')->default(1)->comment('1:Open, 2:Process,3:Pending,4:Close');
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
        Schema::dropIfExists('ticket_complaints');
    }
}
