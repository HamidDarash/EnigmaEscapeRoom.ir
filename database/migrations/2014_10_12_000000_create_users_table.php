<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('family');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('telephone', 30)->nullable();
            $table->string('mobile', 30)->unique();
            $table->mediumText('address')->nullable();
            $table->string('code_melli')->nullable();
            $table->string('zip_code')->nullable();// code posti
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('avatar')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
