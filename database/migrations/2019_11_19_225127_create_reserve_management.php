<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->integer('days');
            $table->date('start_day');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::create('reserve_day_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->date('day');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::create('reserve_day_lists_reserve_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserve_managements_id')
                  ->foreign('reserve_managements_id')
                  ->references('id')->on('reserve_managements')
                  ->onDelete('cascade');
            $table->integer('reserve_day_lists_id')
                  ->foreign('reserve_day_lists_id')
                  ->references('id')->on('reserve_day_lists')
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
        Schema::dropIfExists('reserve_day_lists_reserve_managements');
        Schema::dropIfExists('reserve_day_lists');
        Schema::dropIfExists('reserve_managements');
    }
}
