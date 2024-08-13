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
        Schema::create('remise_dues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_information_id')->references('id')->on('school_information')->onDelete('cascade');
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreignId('scolarite_id')->references('id')->on('scolarites')->onDelete('cascade');
            $table->boolean('status')->default(0);
            $table->float('rest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remise_dues');
    }
};
