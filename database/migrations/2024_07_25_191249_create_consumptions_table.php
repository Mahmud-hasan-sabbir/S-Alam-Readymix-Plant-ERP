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
        Schema::create('consumptions', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->string('quantity')->nullable()->comment('m3');
            $table->string('black_stone')->nullable()->comment('kg');
            $table->string('mixed_builder')->nullable()->comment('kg');
            $table->string('dubai')->nullable()->comment('kg');
            $table->string('mm10')->nullable()->comment('kg');
            $table->string('pcc_cement')->nullable()->comment('kg');
            $table->string('opc_cement')->nullable()->comment('kg');
            $table->string('beg_cement')->nullable()->comment('kg');
            $table->string('sand')->nullable()->comment('kg');
            $table->string('admixer')->nullable()->comment('kg');
            $table->string('bricks')->nullable()->comment('kg');
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('consumptions');
    }
};
