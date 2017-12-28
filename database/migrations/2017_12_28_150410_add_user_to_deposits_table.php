<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToDepositsTable extends Migration
{

    public function up()
    {
        Schema::table('deposits', function($table) {
            $table->string('user')->nullable();
        });
    }

    public function down()
    {
        Schema::table('deposits', function($table) {
            $table->dropColumn('user');
        });
    }
}
