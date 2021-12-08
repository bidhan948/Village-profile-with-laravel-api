<?php

use App\Http\Controllers\api\AddressDropdownController;
use App\Http\Controllers\api\authController;
use App\Http\Controllers\api\ProfileDataController;
use App\Http\Controllers\api\SurveyController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [authController::class, 'login'])->name('api.login');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('survey/get-data', [SurveyController::class, 'index'])->name('survey.index');
    Route::post('logout', [authController::class, 'logout']);
    Route::post('survey/store', [SurveyController::class, 'store'])->name('survey.store');
    Route::get('profile/get-data', [ProfileDataController::class, 'index'])->name('profile.index');
});
Route::get('address', [AddressDropdownController::class, 'province'])->name('api.address');
Route::get('groupcode', [ProfileDataController::class, 'getGroupMember'])->name('api.groupcode');
