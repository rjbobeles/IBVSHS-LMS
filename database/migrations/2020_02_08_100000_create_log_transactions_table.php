<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->bigInteger('actor_id')->unsigned();
            $table->foreign('actor_id')->references('id')->on('users');
            $table->bigInteger('patron_id')->unsigned();
            $table->foreign('patron_id')->references('id')->on('patrons');
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books');
            $table->string('action', 1000);
            $table->date('date_issued');
            $table->date('date_due');
            $table->date('date_returned')->nullable();
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
        Schema::dropIfExists('log_transactions');
    }
}
