<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('application_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('application_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained(); // Who made the change
        $table->string('old_status')->nullable();
        $table->string('new_status');
        $table->text('remarks')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_histories');
    }
};
