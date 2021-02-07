<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTekenCommercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teken_commercials', function (Blueprint $table) {
            $table->Increments('tkc_id');
            $table->string('tkc_Date');
            $table->integer('tkc_social')->unsigned();
            $table->foreign('tkc_social')->references('bt_id')->on('business_trackings');
            $table->string('tkc_teken',500);
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
        Schema::dropIfExists('teken_commercials');
    }
}
