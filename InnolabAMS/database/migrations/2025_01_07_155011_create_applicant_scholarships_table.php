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
        Schema::create('applicant_scholarship', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('applicant_info_id'); 
            $table->string('current_scholarship', 225)->nullable(); 
            $table->enum('annual_household_income', [
                'Below 150,000',
                '150,000 - 300,000',
                '300,001 - 500,000',
                '500,001 - 750,000',
                '750,001 - 1,000,000',
                'Above 1,000,000'
            ])->notNullable(); 
            $table->string('applicant_signature', 225); 
            $table->string('parent_signature', 225);
            $table->string('scholarship_document', 225)->nullable(); 
            $table->timestamps(); 
            

            // Foreign key constraint for applicant_info_id
            $table->foreign('applicant_info_id')
                ->references('id')
                ->on('applicant_info')
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
