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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inv_id')->nullable();
            $table->bigInteger('grade_id')->nullable();
            $table->string('location')->nullable();
            $table->double('qty_m3')->nullable()->comment('qty_m3');
            $table->double('qty_cft')->nullable()->comment('qty_cft');
            $table->double('unit_price_cft')->nullable()->comment('unit_price_cft');
            $table->string('service_search')->nullable()->comment('service_search');
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
        Schema::dropIfExists('invoice_details');
    }
};
