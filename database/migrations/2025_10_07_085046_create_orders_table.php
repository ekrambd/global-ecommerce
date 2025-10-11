<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('orderdetail_id');
            $table->string('variants')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('varaint_id')->nullable();
            $table->string('price');
            $table->string('discount')->default('0')->nullable();
            $table->string('qty');
            $table->string('unit_total');
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
        Schema::dropIfExists('orders');
    }
};
