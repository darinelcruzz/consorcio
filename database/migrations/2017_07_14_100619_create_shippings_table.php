<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('remission')->nullable();
            $table->string('date')->nullable();
            $table->string('provider')->nullable();
            $table->string('product')->nullable();
            $table->longText('processed')->nullable();
            $table->double('quantity')->nullable();
            $table->double('price')->nullable();
            $table->double('amount')->nullable();
            $table->string('observations')->nullable();

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
        Schema::dropIfExists('shippings');
    }
}
