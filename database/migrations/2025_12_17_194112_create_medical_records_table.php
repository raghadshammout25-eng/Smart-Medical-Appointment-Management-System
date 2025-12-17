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
        Schema::create('medical_records', function (Blueprint $table) {

              $table->id('medical_record_id');
              $table->unsignedBigInteger('patient_id'); // FK للمريض
              $table->unsignedBigInteger('doctor_id');  // FK للطبيب
              $table->text('diagnosis');       // التشخيص
              $table->text('treatment');       // العلاج
              $table->date('visit_date');      // تاريخ الزيارة
              $table->string('attachment')->nullable(); // ملف مرفق
              $table->timestamps();
              // العلاقات
              $table->foreign('patient_id')
              ->references('patient_id')->on('patients')
              ->onDelete('cascade');

              $table->foreign('doctor_id')
              ->references('doctor_id')->on('doctors')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
