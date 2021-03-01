<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->Increments('req_id');
            $table->string('req_ide',15);
            $table->integer('req_cli')->unsigned();
            $table->string('req_user',100);
            $table->bigInteger('req_con');
            $table->text('req_sol1',500);
            $table->text('req_sol2',500);
            $table->text('req_sol3',500);
            $table->integer('req_cola')->unsigned();
            $table->timestamps();

            $table->foreign('req_cli')->references('id')->on('user_clients');
            $table->foreign('req_cola')->references('id')->on('collaborators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
