<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBalanceAndUnpaidNotesToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function($table) {
            $table->unsignedInteger('unpaid_notes')->default(0);
            $table->double('balance')->default(0);
        });
    }

    public function down()
    {
        Schema::table('clients', function($table) {
            $table->dropColumn('unpaid_notes');
            $table->dropColumn('balance');
        });
    }
}
