<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('actor');
            $table->string('action', 1000);
            $table->bigInteger('user_id');
            $table->string('firstname', 500);
            $table->string('middlename', 500);
            $table->string('lastname', 500);
            $table->string('role', 30);
            $table->string('username', 250);
            $table->string('password', 200);
            $table->boolean('deactivated');
            $table->string('email', 250);
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
        Schema::dropIfExists('log_users');
    }
}
