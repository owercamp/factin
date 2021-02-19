<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->Increments('con_id');
            $table->bigInteger('conNumber');
            $table->integer('con_social')->unsigned();
            $table->enum('con_typeiderepre',['CEDULA DE CIUDADANIA','NIT','PASAPORTE','CEDULA DE EXTRANJERIA']);
            $table->string('con_repre');
            $table->bigInteger('con_numero');
            $table->string('con_ini');
            $table->string('con_final');
            $table->bigInteger('con_price');
            $table->integer('con_quota')->autoIncrement(false);
            $table->bigInteger('con_valueqouta');
            $table->string('con_fquota');
            $table->timestamps();

            $table->foreign('con_social')->references('legal_id')->on('agreements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
