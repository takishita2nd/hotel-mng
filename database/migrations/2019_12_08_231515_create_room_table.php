<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        Schema::create('reserve_management_room', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserve_management_id')
                  ->foreign('reserve_management_id')
                  ->references('id')->on('reserve_managements')
                  ->onDelete('cascade');
            $table->integer('room_id')
                  ->foreign('room_id')
                  ->references('id')->on('rooms')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserve_management_room');
        Schema::dropIfExists('rooms');
    }
}
