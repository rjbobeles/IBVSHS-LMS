<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('actor_id')->unsigned();
            $table->foreign('actor_id')->references('id')->on('users');
            $table->string('action', 1000);
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books');
            $table->string('callnumber', 200);
            $table->string('title', 300);
            $table->string('author', 300);
            $table->string('isbn', 30);
            $table->string('volume', 300)->nullable();
            $table->string('edition', 300)->nullable();
            $table->integer('year_published');
            $table->string('publisher', 300);
            $table->string('genre', 300);
            $table->string('condition', 300);
            $table->string('status', 300);
            $table->string('barcodeno', 300);
            $table->string('book_image', 300);
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
        Schema::dropIfExists('log_books');
    }
}
