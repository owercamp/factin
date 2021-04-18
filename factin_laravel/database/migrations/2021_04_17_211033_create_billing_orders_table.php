exit<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_orders', function (Blueprint $table) {
            $table->Increments('bo_id');
            $table->bigInteger('bo_sale_month');
            $table->string('bo_month');
            $table->string('bo_year');
            $table->json('bo_data');          
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
        Schema::dropIfExists('billing_orders');
    }
}
