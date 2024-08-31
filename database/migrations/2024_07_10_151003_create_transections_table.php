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
        Schema::create('transections', function (Blueprint $table) {
            $table->id();
            $table->integer('Member_code')->nullable();
            $table->string('VNo')->nullable();
            $table->string('Vtype')->nullable();
            $table->date('VDate')->nullable();
            $table->string('HeadCode')->nullable();
            $table->text('Description')->nullable();
            $table->string('Debit')->default(0);
            $table->string('Credit')->default(0);
            $table->integer('StoreID')->default(0);
            $table->char('IsPosted')->default(0);
            $table->string('CreateBy')->nullable();
            $table->string('UpdateBy')->nullable();
            $table->string('IsAppove')->default(0);
            $table->text('Co_remarks')->nullable();
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
        Schema::dropIfExists('transections');
    }
};
