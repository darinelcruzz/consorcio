<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_movements', function (Blueprint $table) {
            $table->increments('id');

            $table->string('movable_type');
            $table->unsignedInteger('movable_id');
            $table->unsignedInteger('product_id');
            $table->float('price')->default(0);
            $table->unsignedInteger('quantity')->default(1);
            $table->float('discount')->default(0);
            $table->float('total')->default(0);
            
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
        Schema::dropIfExists('sale_movements');
    }
}
