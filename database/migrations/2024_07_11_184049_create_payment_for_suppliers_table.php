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
        Schema::create('payment_for_suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id')->nullable();
            $table->string('po_no')->nullable();
            $table->string('pay_reason')->nullable();
            $table->string('pay_mode')->nullable();
            $table->date('pay_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('check_num')->nullable();
            $table->date('check_date')->nullable();
            $table->integer('pay_amount')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('is_approve')->default(0);
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
        Schema::dropIfExists('payment_for_suppliers');
    }
};
