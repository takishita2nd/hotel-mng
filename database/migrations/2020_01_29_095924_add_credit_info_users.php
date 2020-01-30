<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreditInfoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('credit_number')->after('phone');
            $table->string('mm')->after('credit_number');
            $table->string('yy')->after('mm');
            $table->string('credit_name')->after('yy');
            $table->string('code')->after('credit_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('credit_number');
            $table->dropColumn('mm');
            $table->dropColumn('yy');
            $table->dropColumn('credit_name');
            $table->dropColumn('code');
        });
    }
}
