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
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kind_id')->unsigned()->nullable();
            $table->bigInteger('price');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();


            $table
                ->foreign('kind_id')
                ->references('id')
                ->on('kinds')
                ->onDelete('cascade')
                ->nullOnDelete();

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
        Schema::dropIfExists('books');
    }
};
