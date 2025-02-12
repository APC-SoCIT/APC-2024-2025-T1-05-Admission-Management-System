<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('applicant_infos', 'status')) {
                $table->enum('status', ['new', 'accepted', 'rejected'])->default('new')->after('user_id');
            }
            
            if (!Schema::hasColumn('applicant_infos', 'student_type')) {
                $table->enum('student_type', ['transferee_new', 'existing', 'returning'])->after('status')->nullable();
            }
            
            if (!Schema::hasColumn('applicant_infos', 'previous_school')) {
                $table->string('previous_school')->nullable()->after('student_type');
            }
            if (!Schema::hasColumn('applicant_infos', 'transfer_reason')) {
                $table->text('transfer_reason')->nullable()->after('previous_school');
            }
            if (!Schema::hasColumn('applicant_infos', 'gap_period')) {
                $table->string('gap_period', 50)->nullable()->after('transfer_reason');
            }
            if (!Schema::hasColumn('applicant_infos', 'return_reason')) {
                $table->text('return_reason')->nullable()->after('gap_period');
            }
            if (!Schema::hasColumn('applicant_infos', 'current_grade_level')) {
                $table->string('current_grade_level')->nullable()->after('return_reason');
            }
            if (!Schema::hasColumn('applicant_infos', 'academic_status')) {
                $table->enum('academic_status', ['regular', 'irregular', 'probation'])->nullable()->after('current_grade_level');
            }
            if (!Schema::hasColumn('applicant_infos', 'birth_certificate_path')) {
                $table->string('birth_certificate_path')->nullable()->after('academic_status');
            }
            if (!Schema::hasColumn('applicant_infos', 'photo_path')) {
                $table->string('photo_path')->nullable()->after('birth_certificate_path');
            }
            if (!Schema::hasColumn('applicant_infos', 'form_137_path')) {
                $table->string('form_137_path')->nullable()->after('photo_path');
            }
            if (!Schema::hasColumn('applicant_infos', 'form_138_path')) {
                $table->string('form_138_path')->nullable()->after('form_137_path');
            }
            if (!Schema::hasColumn('applicant_infos', 'good_moral_path')) {
                $table->string('good_moral_path')->nullable()->after('form_138_path');
            }
            if (!Schema::hasColumn('applicant_infos', 'guardian_id_path')) {
                $table->string('guardian_id_path')->nullable()->after('good_moral_path');
            }
            if (!Schema::hasColumn('applicant_infos', 'medical_records_path')) {
                $table->string('medical_records_path')->nullable()->after('guardian_id_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->dropColumn([
                'student_type',
                'previous_school',
                'transfer_reason',
                'gap_period',
                'return_reason',
                'current_grade_level',
                'academic_status',
                'birth_certificate_path',
                'photo_path',
                'form_137_path',
                'form_138_path',
                'good_moral_path',
                'guardian_id_path',
                'medical_records_path'
            ]);
        });
    }
};