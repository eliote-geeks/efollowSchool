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
        Schema::create('moratoires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scolarite_id')->references('id')->on('scolarites')->onDelete('cascade');
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('name');
            $table->timestamp('end_date');
            $table->string('file_path');
            $table->foreignId('school_information_id')->references('id')->on('school_information')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moratoires');
    }
};
