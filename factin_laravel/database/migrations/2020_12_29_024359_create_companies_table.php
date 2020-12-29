<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->Increments('comid');
            $table->string('comsocial',100);
            $table->string('comnit',12);
            $table->integer('comdepid')->unsigned();
            $table->foreign('comdepid')->references('depid')->on('locations');
            $table->integer('communid')->unsigned();
            $table->foreign('communid')->references('munid')->on('municipalities');
            $table->string('comaddress',100);
            $table->integer('comphone1',10)->autoIncrement(false);
            $table->integer('comphone2',10)->autoIncrement(false);
            $table->string('comemail',50);
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
        Schema::dropIfExists('companies');
    }
}
