<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the existing name column
            $table->dropColumn('name');

            // Add new name columns
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert changes
            $table->string('name');
            $table->dropColumn(['first_name', 'middle_name', 'last_name']);
        });
    }
};
