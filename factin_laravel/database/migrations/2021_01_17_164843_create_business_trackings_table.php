<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_trackings', function (Blueprint $table) {
            $table->Increments('bt_id');
            $table->date('bt_date');
            $table->string('bt_social',100);
            $table->integer('bt_dep')->unsigned();
            $table->foreign('bt_dep')->references('depid')->on('locations');
            $table->integer('bt_mun')->unsigned();
            $table->foreign('bt_mun')->references('munid')->on('municipalities');
            $table->string('bt_adr',100)->nullable();
            $table->string('bt_con',100);
            $table->integer('bt_pho',10)->autoIncrement(false);
            $table->integer('bt_What',10)->autoIncrement(false)->nullable();
            $table->string('bt_ema',100);
            $table->text('bt_Obs',1000);
            $table->enum('bt_status',['APROBADO','NO APROBADO']);
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
        Schema::dropIfExists('business_trackings');
    }
}
