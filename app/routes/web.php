<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/selectresults', function () {
    return Inertia\Inertia::render('SelectResults');
})->name('selectresults');



//authentificated routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/qrcode', function (Request $request) {
        $token = $request->user()->createToken('mobileApp', ['read', 'create', 'update', 'delete'])->plainTextToken;
        return QrCode::format('png')->size(600)->generate('ezw;'.$request->getHttpHost().';' . $token . ';ezw');
    })->name('qrcode');
});
