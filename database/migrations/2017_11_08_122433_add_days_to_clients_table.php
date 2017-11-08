<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDaysToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function($table) {
            $table->integer('days')->default(0);
        });
    }
    public function down()
    {
        Schema::table('clients', function($table) {
            $table->dropColumn('days');
        });
    }
}
