<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObservationsToSalesTable extends Migration
{
    public function up()
    {
        Schema::table('fresh_sales', function($table) {
            $table->string('observations')->nullable();
        });

        Schema::table('pork_sales', function($table) {
            $table->string('observations')->nullable();
        });

        Schema::table('alive_sales', function($table) {
            $table->string('observations')->nullable();
        });

        Schema::table('processed_sales', function($table) {
            $table->string('observations')->nullable();
        });
    }

    public function down()
    {
        Schema::table('fresh_sales', function($table) {
            $table->dropColumn('observations');
        });

        Schema::table('pork_sales', function($table) {
            $table->dropColumn('observations');
        });

        Schema::table('alive_sales', function($table) {
            $table->dropColumn('observations');
        });

        Schema::table('processed_sales', function($table) {
            $table->dropColumn('observations');
        });
    }
}
