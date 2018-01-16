<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessedSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processed_sales', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('folio')->nullable();
            $table->integer('client_id')->nullable();
            $table->date('date')->nullable();
            $table->double('quantity')->nullable();
            $table->double('kg')->nullable();
            $table->double('price')->nullable();
            $table->double('chickens')->nullable();
            $table->double('boxes')->nullable();
            $table->string('products', 800)->nullable();
            $table->double('amount')->nullable();
            $table->integer('credit')->nullable();
            $table->string('days')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('processed_sales');
    }
}
