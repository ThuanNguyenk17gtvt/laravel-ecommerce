<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_id');
            $table->string('phone');
            $table->string('address');
            $table->double('total');
            $table->foreign('name_id')
                  ->references('name_id')
                  ->on('user')
                  ->onDelete('cascade');
            $table->string('status');
            $table->string('ready');
            $table->string('paying');
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
        Schema::dropIfExists('order');
    }
}
