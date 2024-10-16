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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_information_id')->references('id')->on('school_information')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('place_birth');
            $table->timestamp('date_birth');
            $table->string('phone_father')->nullable();
            $table->string('phone_mother')->nullable();
            $table->string('name_father')->nullable();
            $table->string('name_mother')->nullable();
            $table->string('matricular');
            $table->integer('status')->default(0);
            $table->string('sexe');
            $table->double('discount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
