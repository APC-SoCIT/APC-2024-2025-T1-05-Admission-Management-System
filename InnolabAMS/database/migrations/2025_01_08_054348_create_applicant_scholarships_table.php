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
        Schema::create('applicant_scholarships', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('applicant_info_id'); // Foreign key
            $table->string('current_scholarship', 225); // Optional (default to nullable if not specified)
            $table->enum('annual_household_income', [
                'Below 150,000',
                '150,000 - 300,000',
                '300,001 - 500,000',
                'Above 500,000'
            ]); // ENUM for income ranges
            $table->string('applicant_signature', 225); // Required
            $table->string('parent_signature', 225); // Required
            $table->enum('scholarship_type', [
                'Financial Assistance',
                'Public-based',
                'Sports-based'
            ]); // ENUM for scholarship types
            $table->float('discount_awarded'); // Float for discounts
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps(); // This adds both created_at and updated_at columns

            // Foreign key constraint
            $table->foreign('applicant_info_id')
                ->references('id')
                ->on('applicant_infos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_scholarships');
    }
};
