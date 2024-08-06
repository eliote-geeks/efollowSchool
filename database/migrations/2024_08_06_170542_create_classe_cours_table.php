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
        Schema::create('classe_cours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('school_information_id')->references('id')->on('school_informations')->onDelete('cascade');
            $table->timestamp('day');
            $table->foreignId('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreignId('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->time('start_Hour');
            $table->time('end_Hour');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_cours');
    }
};
