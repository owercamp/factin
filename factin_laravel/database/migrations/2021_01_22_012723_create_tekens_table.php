<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTekensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tekens', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('tk_date');
            $table->integer('tk_social')->unsigned();
            $table->foreign('tk_social')->references('bt_id')->on('business_trackings');
            $table->string('tk_teken', 500);
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
        Schema::dropIfExists('tekens');
    }
}
