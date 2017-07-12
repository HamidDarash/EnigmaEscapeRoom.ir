<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'roles',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
            }
        );
        DB::table('roles')->insert(['name' => 'super_admin']);
        DB::table('roles')->insert(['name' => 'admin']);
        DB::table('roles')->insert(['name' => 'user']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }

}