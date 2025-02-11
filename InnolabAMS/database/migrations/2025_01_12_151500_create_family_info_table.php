<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id');
            
            // Father's Information
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_contact_number', 20)->nullable();
            
            // Mother's Information
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_contact_number', 20)->nullable();
            
            // Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_address');
            $table->string('emergency_contact_tel', 20)->nullable();
            $table->string('emergency_contact_mobile', 20)->nullable();
            $table->string('emergency_contact_email')->nullable();
            
            $table->timestamps();
            
            $table->foreign('applicant_id')
                  ->references('id')
                  ->on('applicant_infos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_info');
    }
};