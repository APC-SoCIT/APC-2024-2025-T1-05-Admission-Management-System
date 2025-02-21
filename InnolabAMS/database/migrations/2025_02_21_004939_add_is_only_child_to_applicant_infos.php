<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('applicant_infos', 'is_only_child')) {
                $table->boolean('is_only_child')->default(false)->after('siblings');
            }
            if (!Schema::hasColumn('applicant_infos', 'acceptance_message')) {
                $table->text('acceptance_message')->nullable()->after('status');
            }
            if (!Schema::hasColumn('applicant_infos', 'accepted_at')) {
                $table->timestamp('accepted_at')->nullable()->after('acceptance_message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->dropColumn(['is_only_child', 'acceptance_message', 'accepted_at']);
        });
    }
};
