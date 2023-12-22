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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desc');
            $table->string('profession');
            $table->string('family_related');
            $table->string('sleep_on_hospital');
            $table->string('surgery');
            $table->string('notes')->nullable();
            $table->string('doctor_id')->nullable();
            $table->string('doctor_comment')->nullable();
            $table->string('transaction');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
