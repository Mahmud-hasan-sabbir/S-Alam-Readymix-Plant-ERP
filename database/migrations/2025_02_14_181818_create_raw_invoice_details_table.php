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
        Schema::create('raw_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rawInvoice_id');
            $table->foreign('rawInvoice_id')->references('id')->on('raw_invoices')->onDelete('cascade');


            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');

            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('store_names')->onDelete('cascade');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

            $table->string('location')->nullable();
            $table->integer('Qty')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('sub_total')->nullable();

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
        Schema::dropIfExists('raw_invoice_details');
    }
};
