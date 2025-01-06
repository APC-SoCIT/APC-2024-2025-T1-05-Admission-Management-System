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
        Schema::create('inquiry', function (Blueprint $table) {
            $table->id(); // Primary key: id
            $table->unsignedBigInteger('lead_id'); // Foreign key: lead_id
            $table->unsignedBigInteger('admission_officer_id'); // Foreign key: admission_officer_id
            $table->timestamp('inquiry_submitted')->nullable(); // Inquiry submitted timestamp
            $table->string('details_sent', 225)->nullable(); // Details sent
            $table->timestamp('response_date')->nullable(); // Response date
            $table->enum('inquiry_status', ['New', 'Responded'])->nullable(); // Inquiry status
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry');
    }
};