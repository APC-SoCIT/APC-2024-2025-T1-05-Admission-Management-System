<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siblings_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_info_id');
            $table->boolean('is_only_child')->default(false);
            $table->string('full_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('grade_level')->nullable();
            $table->string('school_attended')->nullable();
            $table->timestamps();

            $table->foreign('family_info_id')
                  ->references('id')
                  ->on('family_info')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siblings_info');
    }
};
