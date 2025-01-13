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
            
            // Father's Information - simplified to single name field
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_contact_num', 12)->nullable();
            
            // Mother's Information - simplified to single name field
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_contact_num', 12)->nullable();
            
            // Guardian's Information - restructured fields
            $table->string('guardian_name');
            $table->string('guardian_street_number')->nullable();
            $table->string('guardian_barangay')->nullable();
            $table->string('guardian_city')->nullable();
            $table->string('guardian_telephone')->nullable();
            $table->string('guardian_mobile')->nullable();
            $table->string('guardian_email')->nullable();
            
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