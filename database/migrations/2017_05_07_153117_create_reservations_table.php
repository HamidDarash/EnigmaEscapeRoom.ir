<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('game_id');
            $table->date('date_reserved');
            $table->string('time_reserved')->default('00:00:00');
            $table->boolean('activate')->default(0);
            $table->boolean('canceled')->default(0);
            $table->boolean('law_ok')->default(0);
            $table->text('description')->nullable(true);
            $table->integer('person_count')->default(0);
            $table->string('sum_price')->default('0')->nullable();
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
        Schema::drop('reservations');
    }
}
