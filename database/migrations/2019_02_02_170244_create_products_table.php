<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            // $table->unsignedInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            $table->string('name', 200);
            $table->mediumText('description')->nullable();
            $table->integer('stock')->nullable();
            $table->float('price_cost', 8, 2)->nullable();
            $table->float('price_sale', 8, 2)->nullable();    
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->unsigned()->index();   
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->index();   
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

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
        Schema::dropIfExists('products');
        Schema::dropIfExists('category_product');
    }
}
