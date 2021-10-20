<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('settings')->group(function () {
        Route::resource('marriage', \App\Http\Controllers\MarriageController::class);
        Route::resource('occupation', \App\Http\Controllers\OccupationController::class);
        Route::resource('education', \App\Http\Controllers\EducationController::class);
        Route::resource('disability_type', \App\Http\Controllers\DisabilityTypeController::class);
        Route::resource('disability_card', \App\Http\Controllers\DisabilityCardController::class);
        Route::resource('disability_tool', \App\Http\Controllers\DisabilityToolController::class);
        Route::resource('foreign_country', \App\Http\Controllers\Setting\ForeignCountryController::class);
        Route::resource('foreign-settlement-reason', \App\Http\Controllers\Setting\ForeignCountrySettlementReasonController::class);
        Route::resource('remitance', \App\Http\Controllers\Setting\RemitanceController::class);
        Route::resource('drinking-water-source', \App\Http\Controllers\Setting\DrinkingwaterSourceController::class);
        Route::resource('water-purify', \App\Http\Controllers\Setting\WaterPurifyController::class);
        Route::resource('toilet-type', \App\Http\Controllers\Setting\ToiletTypeController::class);
        Route::resource('gender', \App\Http\Controllers\Setting\GenderController::class);
    });
});
