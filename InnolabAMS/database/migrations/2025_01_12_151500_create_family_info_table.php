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
            // Father's Information
            $table->string('father_surname', 255)->nullable();
            $table->string('father_given_name', 255)->nullable();
            $table->string('father_middle_name', 255)->nullable();
            $table->string('father_occupation', 255)->nullable();
            $table->string('father_contact_num', 12)->nullable();
            
            // Mother's Information
            $table->string('mother_surname', 255)->nullable();
            $table->string('mother_given_name', 255)->nullable();
            $table->string('mother_middle_name', 255)->nullable();
            $table->string('mother_occupation', 255)->nullable();
            $table->string('mother_contact_num', 12)->nullable();
            
            // Guardian's Information
            $table->enum('guardian_info', ['Same as Father', 'Same as Mother'])->nullable();
            $table->string('guardian_surname', 255);
            $table->string('guardian_given_name', 255);
            $table->string('guardian_middle_name', 255);
            $table->string('guardian_address_street', 255)->nullable();
            $table->string('guardian_address_city', 255)->nullable();
            $table->string('guardian_contact_num', 255);
            $table->string('guardian_email', 255)->nullable();
            
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