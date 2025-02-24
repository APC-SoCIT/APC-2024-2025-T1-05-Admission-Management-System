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
            $table->unsignedBigInteger('user_id');

            // Program Information
            $table->enum('apply_program', ['Kindergarten', 'Elementary', 'High School', 'Senior High School']);
            $table->enum('apply_grade_level', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->enum('apply_strand', ['STEM', 'ABM', 'TECHVOC', 'HUMSS', 'GAS'])->nullable();
            $table->enum('student_type', ['Transferee', 'Existing Student', 'Returning Student']);

            // Personal Information
            $table->string('applicant_surname', 40);
            $table->string('applicant_given_name', 40);
            $table->string('applicant_middle_name', 40)->nullable();
            $table->string('applicant_extension', 10)->nullable();
            $table->date('applicant_date_birth');
            $table->integer('age')->nullable();
            $table->string('applicant_place_birth', 255);
            $table->enum('gender', ['Male', 'Female']);
            $table->string('applicant_tel_no', 20)->nullable();
            $table->string('applicant_address_street', 255);
            $table->string('applicant_address_province', 255);
            $table->string('applicant_address_city', 255);
            $table->string('applicant_barangay', 255);
            $table->string('applicant_nationality', 255);
            $table->string('applicant_religion', 255)->nullable();
            $table->string('applicant_mobile_number', 12);
            $table->string('applicant_email', 255)->nullable();
            $table->string('applicant_photo', 255)->nullable();

            // Educational Background
            $table->string('lrn', 12)->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->string('previous_program')->nullable();
            $table->string('year_of_graduation')->nullable();
            $table->string('awards_honors')->nullable();
            $table->decimal('gwa', 4, 2)->nullable();

            // Family Information
            $table->string('father_given_name')->nullable();
            $table->string('father_middle_name')->nullable();
            $table->string('father_surname')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('mother_given_name')->nullable();
            $table->string('mother_middle_name')->nullable();
            $table->string('mother_surname')->nullable();
            $table->string('mother_contact')->nullable();
            $table->string('guardian_given_name')->nullable();
            $table->string('guardian_middle_name')->nullable();
            $table->string('guardian_surname')->nullable();
            $table->string('guardian_contact_num')->nullable();
            $table->json('siblings')->nullable(); // Will store array of sibling info

            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_address')->nullable();
            $table->string('emergency_contact_tel')->nullable();
            $table->string('emergency_contact_mobile')->nullable();
            $table->string('emergency_contact_email')->nullable();

            // Other existing fields
            $table->text('hobbies')->nullable();
            $table->text('skills')->nullable();
            $table->text('extracurricular_interest')->nullable();
            $table->string('participations', 255)->nullable();
            $table->string('competitions', 255)->nullable();
            $table->enum('referral_source', ['Social Media', 'Alumni', 'Online Ad', 'Website', 'School Fair', 'Other'])->nullable();
            $table->enum('status', ['new', 'accepted', 'rejected'])->default('new');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
