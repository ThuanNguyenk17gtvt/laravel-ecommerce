<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
           $table->string('prod_id')->primary('prod_id');
            $table->string('prod_name');
            $table->double('prod_price');
            $table->string('prod_img');
            $table->integer('prod_warranty');  // bảo hành
            // $table->string('prod_acccessories')->nullable(); //phu kien
            $table->string('prod_condition');  //tình trạng sản phẩm
            // $table->integer('prod_promotion');     // kuyeens mãi sản phẩm
            $table->text('prod_description');    // miêu tả sản phẩm
            $table->tinyInteger('prod_featured');   //sản phẩm đặc trưng ,nổi bật
            $table->integer('prod_amount');  // so luong san pham trong kho
            $table->integer('prod_cate')->unsigned();
            $table->foreign('prod_cate')
                   ->references('cate_id')
                   ->on('category')
                   ->onDelete('cascade');
            $table->double('view')->default(0);
            $table->double('download')->default(0);
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
        Schema::dropIfExists('product');
    }
}
