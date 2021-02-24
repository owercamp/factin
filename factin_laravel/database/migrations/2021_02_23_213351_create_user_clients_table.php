<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_clients', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('uc_cli')->unsigned();
            $table->string('uc_users',100);
            $table->enum('uc_type',['CEDULA DE CIUDADANIA','NIT','PASAPORTE','CEDULA DE EXTRANJERIA']);
            $table->string('uc_ide',15);
            $table->string('uc_email',50);
            $table->string('uc_pho1',15);
            $table->string('uc_pho2',15);
            $table->string('uc_pho3',15);
            $table->timestamps();

            $table->foreign('uc_cli')->references('con_id')->on('contracts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_clients');
    }
}
