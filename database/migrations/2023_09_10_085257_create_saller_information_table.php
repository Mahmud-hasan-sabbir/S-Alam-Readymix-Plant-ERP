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
        Schema::create('saller_information', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('project_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->bigInteger('mobile_no')->nullable();
            $table->string('Email')->nullable();
            $table->string('Designation')->nullable();
            $table->date('Date_of_join')->nullable();
            $table->string('Gender')->nullable();
            $table->string('Status')->nullable();
            $table->string('salary')->nullable();
            $table->text('Address')->nullable();
            $table->text('security_cheque')->nullable();
            $table->text('bank_guaranty')->nullable();
            $table->text('attachment')->nullable();
            $table->text('work_order')->nullable();
            $table->text('nid')->nullable();
            $table->text('image')->nullable();
            $table->date('opening_date')->nullable();
            $table->text('note')->nullable();
            $table->string('Category')->nullable();
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
        Schema::dropIfExists('saller_information');
    }
};
