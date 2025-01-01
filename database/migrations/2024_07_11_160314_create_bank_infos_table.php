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
        Schema::create('bank_infos', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('acc_no')->nullable();
            $table->string('routing_no')->nullable();
            $table->string('acc_type')->nullable();
            $table->string('holder_name')->nullable();
            $table->integer('status')->defalut(0);
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
        Schema::dropIfExists('bank_infos');
    }
};
