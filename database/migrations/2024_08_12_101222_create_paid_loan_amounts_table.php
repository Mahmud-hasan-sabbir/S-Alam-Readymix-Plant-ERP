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
        Schema::create('paid_loan_amounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bank_id')->nullable();
            $table->string('acc_no')->nullable();
            $table->string('loan_amount')->nullable();
            $table->string('interest_loan')->nullable();
            $table->date('date')->nullable();
            $table->text('remarks')->nullable();
            $table->string('year')->nullable();
            $table->string('pay_loan_amount')->nullable();
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
        Schema::dropIfExists('paid_loan_amounts');
    }
};
