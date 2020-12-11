<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseEffController;
use App\Http\Controllers\LogbookPageController;
use App\Http\Controllers\SeriesEffController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingEffController;
use App\Http\Controllers\TrainingPlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//authentificated routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('trainingPlan', TrainingPlanController::class);
    Route::apiResource('training', TrainingController::class);
    Route::apiResource('exercise', ExerciseController::class);
    Route::apiResource('logbookPage', LogbookPageController::class);
    Route::apiResource('trainingEff', TrainingEffController::class);
    Route::apiResource('exerciseEff', ExerciseEffController::class);
    Route::apiResource('seriesEff', SeriesEffController::class);

    Route::post('training/{id}/addToTrainingPlan', [TrainingController::class, 'attach'])->whereNumber('id');
    Route::post('exercise/{id}/addToTraining', [ExerciseController::class, 'attach'])->whereNumber('id');

    Route::get('test', function (Request $r) {
        return $r->user();
    });
});
