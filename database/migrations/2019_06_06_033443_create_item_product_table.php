<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_product', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('item_id')->unsigned()->index();    
            $table->foreign('item_id')->references('id')->on('itens')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->index();   
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            $table->tinyInteger('quantity');   
            $table->decimal('amount', 8, 2);    

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
        Schema::dropIfExists('item_product');
    }
}
