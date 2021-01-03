<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('col_name',100);
            $table->string('col_ide',10);
            $table->integer('col_dep')->unsigned();
            $table->integer('col_mun')->unsigned();
            $table->string('col_adr',100);
            $table->integer('col_ph1',10)->autoIncrement(false);
            $table->integer('col_ph2',10)->autoIncrement(false);
            $table->string('col_ema',50);
            $table->string('col_pho');
            $table->string('col_fir');
            $table->foreign('col_dep')->references('depid')->on('locations');
            $table->foreign('col_mun')->references('munid')->on('municipalities');
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
        Schema::dropIfExists('collaborators');
    }
}
