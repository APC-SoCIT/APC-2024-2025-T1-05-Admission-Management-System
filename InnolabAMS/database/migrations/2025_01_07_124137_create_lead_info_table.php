<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_info', function (Blueprint $table) {
            $table->id('lead_id'); // Creates an auto-incrementing 'lead_id' column
            $table->unsignedBigInteger('lead_additional_info_id');
            $table->string('lead_surname', 225);
            $table->string('lead_given_name', 225);
            $table->string('lead_middle_name', 225)->nullable();
            $table->string('lead_extension', 10)->nullable();
            $table->string('lead_address_city', 225)->nullable();
            $table->string('lead_mobile_number', 13)->nullable(); // no. example " +639123456789 "
            $table->string('lead_email', 225);
            $table->enum('inquired_details', ['OPTION_1', 'OPTION_2', 'OPTION_3']); // Replace with actual ENUM values
            $table->text('lead_message')->nullable();
            $table->string('extracurricular_interest_lead', 225)->nullable();
            $table->enum('skills_lead', ['SKILL_1', 'SKILL_2', 'SKILL_3'])->nullable(); // Replace with actual ENUM values
            $table->enum('desired_career', ['CAREER_1', 'CAREER_2', 'CAREER_3'])->nullable(); // Replace with actual ENUM values
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_info');
    }
}
