<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseEffController;
use App\Http\Controllers\LogbookPageController;
use App\Http\Controllers\SeriesEffController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingEffController;
use App\Http\Controllers\TrainingPlanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//authentificated routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //dynaminc images
    Route::get('/qrcode', function (Request $request) {
        $token = $request->user()->createToken('mobileApp', ['read', 'create', 'update', 'delete'])->plainTextToken;
        return QrCode::format('png')->size(600)->generate('ezw;'.$request->getHttpHost().';' . $token . ';ezw');
    })->name('qrcode');

    //crud
    Route::apiResource('trainingPlan', TrainingPlanController::class);
    Route::apiResource('training', TrainingController::class);
    Route::apiResource('exercise', ExerciseController::class);
    Route::apiResource('logbookPage', LogbookPageController::class);
    Route::apiResource('trainingEff', TrainingEffController::class);
    Route::apiResource('exerciseEff', ExerciseEffController::class);
    Route::apiResource('seriesEff', SeriesEffController::class);
    Route::post('training/{id}/addToTrainingPlan', [TrainingController::class, 'attach']);
    Route::post('exercise/{id}/addToTraining', [ExerciseController::class, 'attach']);

    Route::get('training/fromTP/{id}', [TrainingController::class, 'getFromTrainingPlan']);
    Route::get('exercise/fromT/{id}', [ExerciseController::class, 'getFromTraining']);

    //vue
    Route::get('/selectresults', function () {
        return Inertia\Inertia::render('SelectResults');
    })->name('selectresults');

    Route::get('/selectTrainingPlans', function () {
        return Inertia\Inertia::render('SelectTrainingPlans');
    })->name('selectTrainingPlans');

    Route::get('/selectTrainings/{id}', function ($id) {
        return Inertia\Inertia::render('SelectTrainings', ['id' => $id]);
    })->name('selectTrainings');

    Route::get('/selectExercises/{id}', function ($id) {
        return Inertia\Inertia::render('SelectExercises', ['id' => $id]);
    })->name('selectExercises');

    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');
});
