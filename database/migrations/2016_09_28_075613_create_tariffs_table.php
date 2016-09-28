<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('price', 8, 2);
            $table->smallInteger('days');
            $table->tinyInteger('public')->default(0);
            $table->tinyInteger('mql_cme_oi_levels')->default(0);
            $table->tinyInteger('mql_cme_day_border')->default(0);
            $table->tinyInteger('mql_cme_first_levels')->default(0);
            $table->tinyInteger('mql_cme_second_levels')->default(0);
            $table->tinyInteger('mql_cme_cvs')->default(0);
            $table->tinyInteger('mql_cme_helper')->default(0);
            $table->smallInteger('mql_day_history')->default(0);
            $table->tinyInteger('mql_history_option')->default(0);
            $table->tinyInteger('cp_level_graphics')->default(0);
            $table->tinyInteger('cp_filter')->default(0);
            $table->tinyInteger('cp_second_level')->default(0);
            $table->tinyInteger('cp_comment')->default(0);
            $table->tinyInteger('cp_history_option')->default(0);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tariffs');
    }
}
