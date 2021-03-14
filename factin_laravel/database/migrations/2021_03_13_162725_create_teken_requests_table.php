<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTekenRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teken_requests', function (Blueprint $table) {
            $table->Increments('tkreq_id');
            $table->integer('tkreq_follid')->unsigned();
            $table->date('tkreq_date');
            $table->text('tkreq_obs',500);
            $table->date('tkreq_close');
            $table->timestamps();

            $table->foreign('tkreq_follid')->references('foll_id')->on('followings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teken_requests');
    }
}
