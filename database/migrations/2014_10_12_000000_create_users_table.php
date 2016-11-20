<?php

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
            $table->string('username', 50)->primary();
            $table->integer('id')->unique();
            
            $table->string('password');
            $table->integer('level');

            $table->string('avatar', 100);//->nullable();
            $table->string('email')->unique();
            $table->string('fullname', 100);
            
            $table->string('gender', 10);
            $table->string('address', 100);
            
            $table->string('phone', 20);
            $table->boolean('status');
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
        Schema::drop('users');
    }
}
