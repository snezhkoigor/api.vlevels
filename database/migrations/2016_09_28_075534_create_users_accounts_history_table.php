<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAccountsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_accounts_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->double('balance', 8, 2);
            $table->double('equity', 8, 2);
            $table->date('date');
            $table->engine = 'InnoDB';
            $table->index('account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_accounts_history');
    }
}
