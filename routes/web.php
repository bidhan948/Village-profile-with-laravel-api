<?php

use App\Http\Controllers\MarriageController;
use App\Http\Controllers\Setting\ForeignCountrySettlementReasonController;
use App\Http\Controllers\setting\MunicipalController;
use App\Http\Controllers\setting\ProvinceController;
use App\Http\Controllers\setting\wardController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('settings')->group(function () {
        Route::resource('marriage', MarriageController::class);
        Route::resource('relation', \App\Http\Controllers\Setting\RelationController::class);
        Route::resource('occupation', \App\Http\Controllers\OccupationController::class);
        Route::resource('education', \App\Http\Controllers\EducationController::class);
        Route::resource('disability_type', \App\Http\Controllers\DisabilityTypeController::class);
        Route::resource('disability_card', \App\Http\Controllers\DisabilityCardController::class);
        Route::resource('disability_tool', \App\Http\Controllers\DisabilityToolController::class);
        Route::resource('foreign_country', \App\Http\Controllers\Setting\ForeignCountryController::class);
        Route::resource('foreign-settlement-reason', ForeignCountrySettlementReasonController::class);
        Route::resource('remitance', \App\Http\Controllers\Setting\RemitanceController::class);
        Route::resource('drinking-water-source', \App\Http\Controllers\Setting\DrinkingwaterSourceController::class);
        Route::resource('water-purify', \App\Http\Controllers\Setting\WaterPurifyController::class);
        Route::resource('toilet-type', \App\Http\Controllers\Setting\ToiletTypeController::class);
        Route::resource('gender', \App\Http\Controllers\Setting\GenderController::class);
        Route::resource('fuel', \App\Http\Controllers\Setting\FuelController::class);
        Route::resource('waste-management', \App\Http\Controllers\Setting\WasteManagementController::class);
        Route::resource('animal', \App\Http\Controllers\Setting\AnimalController::class);
        Route::resource('material', \App\Http\Controllers\Setting\MaterialController::class);
        Route::resource('floor', \App\Http\Controllers\Setting\FloorController::class);
        Route::resource('roof', \App\Http\Controllers\Setting\RoofController::class);
        Route::resource('training', \App\Http\Controllers\Setting\TrainingController::class);
        Route::resource('social-training', \App\Http\Controllers\Setting\SocialTrainingController::class);
        Route::resource('wall', \App\Http\Controllers\Setting\WallController::class);
        Route::resource('service', \App\Http\Controllers\Setting\ServiceController::class);
        Route::resource('health-service', \App\Http\Controllers\Setting\HealthServiceController::class);
        Route::resource('disease', \App\Http\Controllers\Setting\DiseaseController::class);
        Route::resource('disaster', \App\Http\Controllers\Setting\DisasterController::class);
        Route::resource('allowance-type', \App\Http\Controllers\Setting\AllowanceTypeController::class);
        Route::resource('union-body', \App\Http\Controllers\Setting\UnionBodyController::class);
        Route::resource('yearly-income', \App\Http\Controllers\Setting\YearlyIncomeController::class);
        Route::resource('yearly-expenditure', \App\Http\Controllers\Setting\YearlyExpenditureController::class);
        Route::resource('irrigation-type', \App\Http\Controllers\Setting\IrrigationTypeController::class);
        Route::resource('ownership', \App\Http\Controllers\Setting\OwnershipController::class);
        Route::resource('industry-type', \App\Http\Controllers\Setting\IndustryTypeController::class);
        Route::resource('unit', \App\Http\Controllers\Setting\UnitController::class);
        Route::resource('entertainment', \App\Http\Controllers\Setting\EntertainmentController::class);
        Route::resource('forest-type', \App\Http\Controllers\Setting\ForestTypeController::class);
        Route::resource('road-type', \App\Http\Controllers\Setting\RoadTypeController::class);
        Route::resource('religion', \App\Http\Controllers\Setting\ReligionController::class);
        Route::resource('crop', \App\Http\Controllers\Setting\CropController::class);
        Route::resource('crop-child', \App\Http\Controllers\Setting\CropChildController::class);
        Route::resource('province', ProvinceController::class);
        Route::resource('municipal',MunicipalController::class);
        Route::resource('ward',wardController::class);
    });
});
