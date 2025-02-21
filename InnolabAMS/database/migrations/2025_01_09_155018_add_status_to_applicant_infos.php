<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('applicant_infos', 'status')) {
                $table->enum('status', ['new', 'accepted', 'rejected'])->default('new')->after('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};