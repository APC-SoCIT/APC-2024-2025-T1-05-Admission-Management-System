<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('lead_info', function (Blueprint $table) {
            $table->string('other_skills_lead')->nullable();
            $table->text('source')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('lead_info', function (Blueprint $table) {
            $table->dropColumn(['other_skills_lead', 'source']);
        });
    }
};