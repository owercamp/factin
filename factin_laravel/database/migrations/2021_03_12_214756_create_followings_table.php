<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followings', function (Blueprint $table) {
            $table->Increments('foll_id');
            $table->string('foll_ide',15);
            $table->integer('foll_cli')->unsigned();
            $table->string('foll_user',100);
            $table->bigInteger('fol_con');
            $table->text('foll_sol1',500);
            $table->text('foll_sol2',500);
            $table->text('foll_sol3',500);
            $table->integer('foll_cola')->unsigned();
            $table->date('foll_date');
            $table->timestamps();

            $table->foreign('foll_cli')->references('id')->on('user_clients');
            $table->foreign('foll_cola')->references('id')->on('collaborators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followings');
    }
}
