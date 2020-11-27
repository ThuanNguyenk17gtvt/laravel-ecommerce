<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prod_id');
            $table->double('price');
            $table->integer('amount');
            $table->foreign('prod_id')
                  ->references('prod_id')
                  ->on('product')
                  ->onDelete('cascade');
            $table->integer('id_order')->unsigned();
            $table->foreign('id_order')
                  ->references('id')
                  ->on('order')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('order_item');
    }
}
