<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->text('hobbies')->nullable()->change();
            $table->text('skills')->nullable()->change();
            $table->text('extracurricular_interest')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('applicant_infos', function (Blueprint $table) {
            $table->string('hobbies')->nullable()->change();
            $table->string('skills')->nullable()->change();
            $table->string('extracurricular_interest')->nullable()->change();
        });
    }
};
