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

            // Program Information
            $table->enum('program', ['Elementary', 'Junior High School', 'Senior High School']);
            $table->string('grade_level');

            // Student Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('photo_path')->nullable();
            $table->string('lrn', 12);
            $table->string('nationality');
            $table->string('religion')->nullable();

            // Family Information
            $table->string('father_name')->nullable();

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
