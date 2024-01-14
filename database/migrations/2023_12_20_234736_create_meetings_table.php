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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('doctor_id')->nullable()->references('id')->on('doctors')->onDelete('cascade');
            $table->string('meeting_id')->nullable();
            $table->string('status')->default('pending');
            $table->string('price');
            $table->string('notes');
            $table->string('profession');
            $table->string('transaction')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('doctor_applied')->nullable();
            $table->timestamp('user_applied')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
