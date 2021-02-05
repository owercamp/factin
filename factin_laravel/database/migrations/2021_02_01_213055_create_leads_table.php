<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->Increments('lead_id');
            $table->string('lead_Date');
            $table->integer('lead_social')->unsigned();
            $table->enum('lead_tide',['CEDULA DE CIUDADANIA','NIT','PASAPORTE']);
            $table->string('lead_ide',50);
            $table->integer('lead_dep')->unsigned();
            $table->integer('lead_mun')->unsigned();
            $table->string('lead_adr',100)->nullable();
            $table->string('lead_con',100);
            $table->integer('lead_pho',10)->autoIncrement(false);
            $table->integer('lead_what',10)->autoIncrement(false)->nullable();
            $table->string('lead_ema',100);
            $table->text('lead_obs',1000);
            $table->string('lead_pro');
            $table->integer('lead_value')->autoIncrement(false);
            $table->integer('lead_quantity')->autoIncrement(false);
            $table->integer('lead_sub')->autoIncrement(false);
            $table->integer('lead_porcentage')->autoIncrement(false);
            $table->integer('lead_iva')->autoIncrement(false);
            $table->integer('lead_total')->autoIncrement(false);
            $table->enum('lead_status',['','APROBADO','NO APROBADO'])->nullable();
            $table->timestamps();

            $table->foreign('lead_social')->references('bt_id')->on('business_trackings');
            $table->foreign('lead_dep')->references('depid')->on('locations');
            $table->foreign('lead_mun')->references('munid')->on('Municipalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
