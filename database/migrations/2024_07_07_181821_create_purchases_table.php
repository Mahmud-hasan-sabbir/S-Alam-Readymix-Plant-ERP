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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('PO_No')->nullable();
            $table->date('order_date')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('Total_purchase_amount')->nullable();
            $table->string('discount')->nullable();
            $table->integer('status')->defalut(1);
            $table->integer('is_approve')->defalut(0);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
