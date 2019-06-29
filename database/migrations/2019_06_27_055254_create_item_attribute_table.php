<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->index();    
            $table->foreign('item_id')->references('id')->on('itens')->onDelete('cascade');

            $table->integer('attribute_id')->unsigned()->index();   
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
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
        Schema::dropIfExists('item_attribute');
    }
}
