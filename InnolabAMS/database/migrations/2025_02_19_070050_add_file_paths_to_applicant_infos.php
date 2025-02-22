<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            // File path columns
            if (!Schema::hasColumn('applicant_infos', 'birth_certificate_path')) {
                $table->string('birth_certificate_path')->nullable();
            }
            if (!Schema::hasColumn('applicant_infos', 'form_137_path')) {
                $table->string('form_137_path')->nullable();
            }
            if (!Schema::hasColumn('applicant_infos', 'form_138_path')) {
                $table->string('form_138_path')->nullable();
            }
            if (!Schema::hasColumn('applicant_infos', 'id_picture_path')) {
                $table->string('id_picture_path')->nullable();
            }
            if (!Schema::hasColumn('applicant_infos', 'good_moral_path')) {
                $table->string('good_moral_path')->nullable();
            }

            // Required columns that were missing
            if (!Schema::hasColumn('applicant_infos', 'user_id')) {
                $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade');
            }
            if (!Schema::hasColumn('applicant_infos', 'student_type')) {
                $table->string('student_type')->nullable();
            }
            if (!Schema::hasColumn('applicant_infos', 'status')) {
                $table->string('status')->default('new');
            }
            if (!Schema::hasColumn('applicant_infos', 'siblings')) {
                $table->json('siblings')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            // Drop file path columns
            $table->dropColumn([
                'birth_certificate_path',
                'form_137_path',
                'form_138_path',
                'id_picture_path',
                'good_moral_path'
            ]);

            // Drop other columns
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'student_type',
                'status',
                'siblings'
            ]);
        });
    }
};
