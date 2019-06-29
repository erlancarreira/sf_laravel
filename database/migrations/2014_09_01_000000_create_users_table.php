<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id'); 
            $table->integer('user_id')->nullable();  
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('citys')->onDelete('cascade');
            
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->bigInteger('phone')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('image', 100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
