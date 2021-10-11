<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('settings')->group(function () {
        Route::resource('marriage',\App\Http\Controllers\MarriageController::class);
        Route::resource('occupation',\App\Http\Controllers\OccupationController::class);
        Route::resource('education',\App\Http\Controllers\EducationController::class);
    });
});
