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
                '500,001 - 750,000',
                '750,001 - 1,000,000',
                'Above 1,000,000'
            ]); // ENUM for income ranges
            $table->string('applicant_signature', 225); // Required
            $table->string('parent_signature', 225); // Required
            $table->enum('scholarship_type', [
                'Financial Assistance',
                'Public-based',
                'Sports-based'
            ]); // ENUM for scholarship types
            $table->float('discount_awarded'); // Float for discounts
            $table->timestamp('updated_at')->useCurrent(); // Timestamp

            // Foreign key constraint
            $table->foreign('applicant_info_id')
                ->references('id')
                ->on('applicant_infos') // Adjust table name to match your schema
                ->onDelete('cascade'); // Cascade delete
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
