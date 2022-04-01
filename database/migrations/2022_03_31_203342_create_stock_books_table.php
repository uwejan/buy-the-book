<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_books', function (Blueprint $table) {
            $table->increments('id');

            $table
                ->integer('book_id')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');


            $table->integer('quantity')->default(10);

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
        Schema::dropIfExists('stock_books');
    }
};
