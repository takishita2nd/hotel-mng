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
            $table->increments('id');                   // ID
            $table->string('name');                     // 名前
            $table->string('address');                  // 住所
            $table->string('phone');                    // 電話番号
            $table->integer('num');                     // 人数
            $table->integer('days');                    // 宿泊日数
            $table->date('start_day');                  // 宿泊初日
            $table->timestamps();                       // タイムスタンプ
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::create('reserve_day_lists', function (Blueprint $table) {
            $table->increments('id');                   // ID
            $table->date('day');                        // 宿泊日
            $table->timestamps();                       // タイムスタンプ
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
