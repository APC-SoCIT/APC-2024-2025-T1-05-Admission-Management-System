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

        // Create the new lead_info table
        Schema::create('lead_info', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            // Lead information columns
            $table->string('lead_surname', 225);
            $table->string('lead_given_name', 225);
            $table->string('lead_middle_name', 225)->nullable();
            $table->string('lead_extension', 10)->nullable();
            $table->string('lead_address_city', 225)->nullable();
            $table->string('lead_mobile_number', 13)->nullable(); // Example: +639123456789
            $table->string('lead_email', 225);
            $table->enum('inquired_details', [
                'Application Requirements', 
                'Application Process', 
                'Tuition Fees', 
                'Scholarship Opportunities', 
                'Program Offerings', 
                'Admission Deadlines', 
                'Others']);
            $table->text('lead_message')->nullable();
            $table->string('extracurricular_interest_lead', 225)->nullable();
            $table->enum('skills_lead', [
                'Communication', 'Teamwork', 'Leadership', 
                'Problem-Solving', 'Time Management', 'Creativity', 
                'Adaptability', 'Technology-related', 'Others'
            ])->nullable();
            $table->string('desired_career', 225)->nullable();

            // Inquiry columns
            $table->timestamp('inquiry_submitted')->nullable();
            $table->string('details_sent', 225)->nullable();
            $table->timestamp('response_date')->nullable(); // Nullable to allow for no response date initially
            $table->enum('inquiry_status', ['New', 'Responded'])->default('New'); // Default to 'New'

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
        // Drop the newly created lead_info table
        Schema::dropIfExists('lead_info');
    }
}