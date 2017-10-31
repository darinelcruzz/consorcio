<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('rfc')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->integer('credit')->default(0);
            $table->integer('notes')->default(0);
            $table->string('products');

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
        Schema::dropIfExists('clients');
    }
}
