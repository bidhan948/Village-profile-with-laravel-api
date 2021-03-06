<?php

use App\Http\Controllers\{CommitteePostController, FiscalController, MarriageController};
use App\Http\Controllers\meeting\MeetingController;
use App\Http\Controllers\Report\SurveyReportController;
use App\Http\Controllers\Setting\{ForeignCountrySettlementReasonController, PostController, RoleController};
use App\Http\Controllers\survey\TransferController;
use App\Http\Controllers\System_setting\ManagePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    /****************** below route is all for committe formed report****************************/
    Route::get('committe-formed/assign/{code}',[CommitteePostController::class,'assignPost'])->name('committee-formed.assign');
    Route::resource('committee-formed', CommitteePostController::class)->except('edit','update','show','delete','create');
    /****************** below route is all for meeting ****************************/
    Route::post('submitDecision/{meeting}',[MeetingController::class,'meetingFinalStore'])->name('meeting_finish');
    Route::post('Proposal/{meeting}',[MeetingController::class,'addMorePrposal'])->name('addMorePrposal');
    Route::get('operate-meeting/{meeting}',[MeetingController::class,'oprateMeeting'])->name('oprateMeeting');
    Route::post('operate-meeting/{meeting}',[MeetingController::class,'proposalApproveReject'])->name('oprateMeetingSubmit');
    Route::resource('meeting',MeetingController::class);
    /****************** below route is all for survey report****************************/
    Route::get('survey-data', [SurveyReportController::class, 'index'])->name('report.survey');
    Route::post('survey-data', [SurveyReportController::class, 'report'])->name('report.survey');
    /****************** below route is all for transfer****************************/
    Route::get('survey/transfer-detail', [TransferController::class, 'index'])->name('transfer.index');
    Route::get('survey/transfer/{surveyData}', [TransferController::class, 'transfer'])->name('survey.transfer');
    Route::post('survey/transfer/{surveyData}', [TransferController::class, 'store'])->name('survey.transfer');
    /****************** below route is all for users****************************/
    Route::get('user/status-switch/{user}', [UserController::class, 'switchStatus'])->name('user.status');
    Route::resource('user', UserController::class);

    /****************** below route is all for system setting****************************/
    Route::prefix('system-settings')->group(function () {
        Route::get('assign-permssion/{role}', [ManagePermissionController::class,'assignPermission'])->name('assign-permssion');
        Route::post('assign-permssion', [ManagePermissionController::class,'assignPermissionStore'])->name('assign_permission_store');
        Route::resource('role', RoleController::class);
        Route::resource('fiscal-year', FiscalController::class);
        Route::resource('permission-manage', ManagePermissionController::class);
        Route::resource('post', PostController::class);
    });
    /****************** end of system setting****************************/

    /****************** below route is all for setting****************************/
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
    });
});
