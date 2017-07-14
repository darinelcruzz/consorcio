<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fresh_sales', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('folio');
            $table->integer('client_id');
            $table->string('date');
            $table->double('quantity');
            $table->double('kg');
            $table->double('price');
            $table->double('amount');
            $table->integer('credit');
            $table->string('days');
            $table->string('status');
            $table->double('deposit')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fresh_sales');
    }
}
