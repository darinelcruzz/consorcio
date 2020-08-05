<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaleTypeToDepositsTable extends Migration
{
    public function up()
    {
        Schema::table('deposits', function($table) {
            $table->string('sale_type');
        });
    }

    public function down()
    {
        Schema::table('deposits', function($table) {
            $table->dropColumn('sale_type');
        });
    }
}
