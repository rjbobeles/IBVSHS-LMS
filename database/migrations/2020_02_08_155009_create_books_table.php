<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('callnumber', 200);
            $table->string('title', 300);
            $table->string('author', 300);
            $table->string('isbn', 300);
            $table->string('volume', 300);
            $table->string('edition', 300);
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
        Schema::dropIfExists('books');
    }
}
