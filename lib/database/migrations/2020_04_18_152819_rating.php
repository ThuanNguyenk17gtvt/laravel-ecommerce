<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->increments('id');
            $table->float('star');
            $table->string('prod_id');
            $table->string('name_id');
            $table->foreign('prod_id')
                    ->references('prod_id')
                   ->on('product')
                   ->onDelete('cascade');
            $table->foreign('name_id')
                    ->references('name_id')
                   ->on('user')
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
        Schema::dropIfExists('rating');
    }
}
