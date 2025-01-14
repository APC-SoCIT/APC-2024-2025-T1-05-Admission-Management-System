<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educational_background', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id');
            $table->string('lrn', 12)->nullable();
            $table->boolean('sped')->default(false);
            $table->boolean('pwd')->default(false);
            $table->string('applicant_school_name')->nullable();
            $table->string('applicant_school_address')->nullable();
            $table->enum('applicant_last_grade_level', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])->nullable();
            $table->date('applicant_year_graduation')->nullable();
            $table->decimal('applicant_gwa', 4, 2)->nullable();
            $table->string('applicant_achievements')->nullable();
            $table->timestamps();

            $table->foreign('applicant_id')
                  ->references('id')
                  ->on('applicant_infos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educational_background');
    }
};