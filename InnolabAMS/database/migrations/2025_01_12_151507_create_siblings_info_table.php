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
            $table->string('sibling_surname')->nullable();
            $table->string('sibling_given_name')->nullable();
            $table->integer('sibling_age')->nullable();
            $table->string('sibling_school_name')->nullable();
            $table->string('sibling_school_address')->nullable();
            $table->string('sibling_grade_level')->nullable();
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