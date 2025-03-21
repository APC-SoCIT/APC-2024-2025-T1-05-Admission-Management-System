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
        Schema::table('applicant_scholarships', function (Blueprint $table) {
            if (!Schema::hasColumn('applicant_scholarships', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])
                      ->default('pending')
                      ->after('discount_awarded');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicant_scholarships', function (Blueprint $table) {
            if (Schema::hasColumn('applicant_scholarships', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
