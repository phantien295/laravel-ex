<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_id', 20);
            $table->string('username', 50);
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->foreign('username')->references('username')->on('users');
            // $table->primary(['book_id', 'username']);
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
        Schema::drop('comments');
    }
}
