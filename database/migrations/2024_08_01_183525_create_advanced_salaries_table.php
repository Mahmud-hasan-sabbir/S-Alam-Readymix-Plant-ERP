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
        Schema::create('advanced_salaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('emp_id')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('pay_mode')->nullable();
            $table->integer('bank_name')->nullable();
            $table->string('acc_no')->nullable();
            $table->integer('advanced_salary')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('advanced_salaries');
    }
};
