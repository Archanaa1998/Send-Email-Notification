<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NotificationController;

Route::get('/email-notification', [NotificationController::class, 'showForm'])->name('email.form');
Route::post('/email-notification', [NotificationController::class, 'sendEmail'])->name('email.send');
