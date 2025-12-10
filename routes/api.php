<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\NotificationController;

// ✅ مسارات CRUD لكل جدول
Route::apiResource('users', UserController::class);
Route::apiResource('patients', PatientController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('medical-records', MedicalRecordController::class);
Route::apiResource('notifications', NotificationController::class);
