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
        Schema::create('security_guard_licenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('security_id');
            $table->string('security_status');
            $table->string('license_type');
            $table->date('renew_date')->nullable();
            $table->date('expire_date');
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_guard_licenses');
    }
};
