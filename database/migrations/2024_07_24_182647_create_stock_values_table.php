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
        Schema::create('stock_values', function (Blueprint $table) {
            $table->id();
            $table->biginteger('material_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('pur_qty')->nullable();
            $table->string('sale_qty')->nullable();
            $table->string('cur_qty')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('stock_values');
    }
};
