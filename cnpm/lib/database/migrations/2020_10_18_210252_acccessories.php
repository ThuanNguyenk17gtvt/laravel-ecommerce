<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Acccessories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acccessories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('acccessorie_name');
            $table->string('acccessorie_img');
            $table->double('acccessorie_price');
            $table->integer('acccessorie_amount');
            $table->integer('cateid')->unsigned();
            $table->foreign('cateid')
                   ->references('cate_id')
                   ->on('category')
                   ->onDelete('cascade');
            $table->integer('prodid')->unsigned();
            $table->foreign('prodid')
                  ->references('prod_id')
                  ->on('product')
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
        Schema::dropIfExists('acccessories');
    }
}
