<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->boolean('is_only_child')->default(false)->after('siblings');
            $table->text('acceptance_message')->nullable()->after('status');
            $table->timestamp('accepted_at')->nullable()->after('acceptance_message');
        });
    }

    public function down(): void
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->dropColumn(['is_only_child', 'acceptance_message', 'accepted_at']);
        });
    }
};
