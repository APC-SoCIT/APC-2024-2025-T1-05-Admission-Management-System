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
        Schema::create('applicant_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['new', 'accepted', 'rejected'])->default('new');
            
            // Program Information
            $table->string('student_type')->nullable();
            $table->string('previous_school')->nullable();
            $table->text('transfer_reason')->nullable();
            $table->string('gap_period')->nullable();
            $table->text('return_reason')->nullable();
            $table->string('current_grade_level')->nullable();
            $table->enum('academic_status', ['regular', 'irregular', 'probation'])->nullable();
            
            // Personal Information
            $table->string('applicant_surname');
            $table->string('applicant_given_name');
            $table->string('applicant_middle_name')->nullable();
            $table->string('applicant_extension')->nullable();
            $table->date('applicant_date_birth');
            $table->integer('age');
            $table->string('gender');
            $table->string('applicant_tel_no')->nullable();
            $table->string('applicant_mobile_number');
            $table->string('applicant_nationality');
            $table->string('applicant_religion');
            
            // Contact Information
            $table->string('applicant_address_street');
            $table->string('applicant_address_city');
            $table->string('applicant_address_province');
            
            // Document Paths
            $table->string('birth_certificate_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('form_137_path')->nullable();
            $table->string('form_138_path')->nullable();
            $table->string('good_moral_path')->nullable();
            $table->string('guardian_id_path')->nullable();
            $table->string('medical_records_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_infos');
    }
};
