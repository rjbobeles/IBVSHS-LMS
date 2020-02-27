<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPatronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_patrons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('actor_id')->unsigned();
            $table->foreign('actor_id')->references('id')->on('users');
            $table->string('action', 1000);
            $table->bigInteger('patron_id')->unsigned();
            $table->foreign('patron_id')->references('id')->on('patrons');
            $table->string('role', 30);
            $table->string('firstname', 50);
            $table->string('middlename', 50);
            $table->string('lastname', 50);
            $table->string('email', 250);
            $table->string('contactno', 100);
            $table->boolean('deactivated');
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
        Schema::dropIfExists('log_patrons');
    }
}
