<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctor_professions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignid('profession_id')->references('id')->on('professions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_professions');
    }
};
