<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_tariffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('tariff_id');
            $table->date('from');
            $table->date('to');
            $table->engine = 'InnoDB';
            $table->index('user_id');
            $table->index('tariff_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_tariffs');
    }
}
