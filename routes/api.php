<?php

use App\Http\Controllers\api\authController;
use App\Http\Controllers\api\SurveyController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [authController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('survey/get-data', [SurveyController::class, 'index'])->name('survey.index');
    Route::post('logout', [authController::class, 'logout']);
    Route::post('survey/store', [SurveyController::class, 'store'])->name('survey.store');
});
