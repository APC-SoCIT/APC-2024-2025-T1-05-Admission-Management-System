<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('applicant_infos', 'applicant_email')) {
                $table->string('applicant_email')->nullable()->after('applicant_mobile_number');
            }
        });
    }

    public function down()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->dropColumn('applicant_email');
        });
    }
};
