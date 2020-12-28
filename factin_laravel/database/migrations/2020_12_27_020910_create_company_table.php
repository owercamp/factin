<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->Increments('comid')->autoIncrement();
            $table->string('comsocial', 100);
            $table->string('comnit',12);
            $table->integer('comdepid')->unsigned()->nullable();
            $table->foreign('comdepid')->references('depid')->on('locations');
            $table->integer('communid')->unsigned()->nullable();
            $table->foreign('communid')->references('munid')->on('municipalities');
            $table->string('comaddress',100);
            $table->integer('comphone1',10)->autoIncrement(false)->nullable();
            $table->integer('comphone2',10)->autoIncrement(false)->nullable();
            $table->string('email',50)->unique();
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
        Schema::dropIfExists('company');
    }
}
