<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->string('book_id', 20)->primary();
            $table->string('name', 100);
            $table->string('author', 50);
            $table->string('publisher', 100);
            $table->string('cat_id', 20);
            $table->integer('pages');
            $table->text('description');
            $table->float('price');
            $table->string('image', 100);
            $table->integer('quantity');
            $table->boolean('status');
            $table->foreign('cat_id')->references('cat_id')->on('categories');
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
        Schema::drop('books');
    }
}


/*
$table->string('cat_id', 20)->primary();
            $table->string('name', 50);
            $table->timestamps();
            */