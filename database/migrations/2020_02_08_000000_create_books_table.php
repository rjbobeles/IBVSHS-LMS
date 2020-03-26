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
            $table->string('isbn', 30);
            $table->string('volume', 10)->nullable();
            $table->string('edition', 10)->nullable();
            $table->integer('year_published');
            $table->string('publisher', 255);
            $table->string('genre', 500); 
            $table->enum('condition', ['Fine', 'Very Good', 'Good', 'Fair', 'Poor']);
            $table->enum('status', ['Available', 'Reserved', 'Borrowed', 'Archived', 'Missing']);
            $table->string('barcodeno', 13); 
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
