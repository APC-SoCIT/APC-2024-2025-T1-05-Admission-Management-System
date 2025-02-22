<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->text('acceptance_message')->nullable();
            $table->timestamp('accepted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->dropColumn(['acceptance_message', 'accepted_at']);
        });
    }
};
