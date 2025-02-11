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
            $table->string('school_name');
            $table->string('school_address');
            $table->string('previous_program')->nullable();
            $table->year('year_of_graduation')->nullable();
            $table->decimal('gwa', 4, 2)->nullable();
            $table->text('awards_honors')->nullable();
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