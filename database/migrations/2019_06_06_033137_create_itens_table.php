<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->index('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            $table->integer('user_id')->index('user_id')->unsigned();   
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->enum('type', ['sale', 'service', 'bill']); 
            $table->date('payment_date');
            $table->enum('payment_method', [1, 2, 3]);
            $table->enum('payment_status', [1, 2, 3]);
            $table->mediumText('description')->nullable(); 
            $table->float('credit', 8, 2)->nullable();
            $table->float('discount', 8, 2)->nullable();
            $table->float('amount_total', 8, 2)->nullable(); 
            
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
        Schema::dropIfExists('itens');
    }
}
