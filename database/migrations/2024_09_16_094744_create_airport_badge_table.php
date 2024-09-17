<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('airport_badge', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); 
            $table->string('security_front_id'); 
            $table->string('security_back_id');  
            $table->string('privilege');
            $table->date('expire_date');
            $table->date('renew_date')->nullable();
            $table->string('front_image');
            $table->string('back_image');
            $table->timestamps();

            // Foreign key for employee_id
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airport_badge');
    }
};
