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
        Schema::create('patients', function (Blueprint $table) {
             $table->id('patient_id');
             $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
             $table->date('birth_date')->nullable();
             $table->string('phone')->nullable();
             $table->enum('gender', ['male', 'female']);
             $table->string('address')->nullable();
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
