<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->timestamp('day')->nullable();
            $table->string('day_of_week')->nullable();
            $table->foreignId('time_slot_id')->references('id')->on('time_slots')->onDelete('cascade');
            $table->string('subject');
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
