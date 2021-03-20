<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ratings', function (Blueprint $table) {
            $table->Increments('ur_id');
            $table->integer('ur_cli')->unsigned();
            $table->string('ur_user', 100);
            $table->enum('ur_cali',['EXCELENTE','BUENO','REGULAR','MALO']);
            $table->text('ur_obs',200);
            $table->timestamps();

            $table->foreign('ur_cli')->references('foll_id')->on('followings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ratings');
    }
}
