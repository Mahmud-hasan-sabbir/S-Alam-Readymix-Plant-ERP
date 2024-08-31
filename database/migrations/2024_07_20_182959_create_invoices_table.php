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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('inv_no')->nullable();
            $table->date('date');
            $table->biginteger('cus_id')->nullable();
            $table->text('description')->nullable();
            $table->string('total_amount')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=Pending, 1=Approved');
            $table->integer('consum')->default('0')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
