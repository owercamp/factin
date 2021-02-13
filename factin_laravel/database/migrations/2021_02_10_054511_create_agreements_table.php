<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->Increments('legal_id');
            $table->integer('legal_social')->unsigned();
            $table->integer('legal_dep')->unsigned();
            $table->integer('legal_mun')->unsigned();
            $table->string('legal_adr',100);
            $table->integer('legal_pho',10)->autoIncrement(false);
            $table->integer('legal_what',10)->autoIncrement(false)->nullable();
            $table->string('legal_ema',100);
            $table->enum('legal_typeClient',['PERSONA NATURAL','PERSONA JURIDICA']);
            $table->enum('legal_typeDocRSocial',['CEDULA DE CIUDADANIA','NIT','PASAPORTE','CEDULA DE EXTRANJERIA']);
            $table->string('legal_DocRSocial',15);
            $table->string('legal_repre',50);
            $table->enum('legal_typeDocRepre',['CEDULA DE CIUDADANIA','NIT','PASAPORTE','CEDULA DE EXTRANJERIA']);
            $table->string('legal_DocRepre',15);
            $table->timestamps();

            $table->foreign('legal_social')->references('lead_id')->on('leads');
            $table->foreign('legal_dep')->references('depid')->on('locations');
            $table->foreign('legal_mun')->references('munid')->on('municipalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreements');
    }
}
