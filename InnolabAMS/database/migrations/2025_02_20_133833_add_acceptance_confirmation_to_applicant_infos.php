<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->text('acceptance_message')->nullable();
            $table->timestamp('accepted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            if (Schema::hasColumn('applicant_infos', 'acceptance_message')) {
                $table->dropColumn('acceptance_message');
            }
            if (Schema::hasColumn('applicant_infos', 'accepted_at')) {
                $table->dropColumn('accepted_at');
            }
        });
    }
};