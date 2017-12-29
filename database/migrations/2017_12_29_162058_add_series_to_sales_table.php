<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeriesToSalesTable extends Migration
{
    public function up()
    {
        Schema::table('fresh_sales', function($table) {
            $table->string('series')->nullable();
        });

        Schema::table('pork_sales', function($table) {
            $table->string('series')->nullable();
        });

        Schema::table('alive_sales', function($table) {
            $table->string('series')->nullable();
        });

        Schema::table('processed_sales', function($table) {
            $table->string('series')->nullable();
        });
    }

    public function down()
    {
        Schema::table('fresh_sales', function($table) {
            $table->dropColumn('series');
        });

        Schema::table('pork_sales', function($table) {
            $table->dropColumn('series');
        });

        Schema::table('alive_sales', function($table) {
            $table->dropColumn('series');
        });

        Schema::table('processed_sales', function($table) {
            $table->dropColumn('series');
        });
    }
}
