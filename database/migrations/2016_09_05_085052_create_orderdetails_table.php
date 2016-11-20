<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->string('orderid', 50);
            $table->string('book_id', 20);
            $table->integer('percent');
            $table->integer('quantity');
            $table->float('price');
            $table->primary(['book_id', 'orderid']);
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->foreign('orderid')->references('orderid')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orderdetails');
    }
}
