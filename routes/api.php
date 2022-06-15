<?php

use App\Http\Controllers\V1\CalendarController;
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

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('v1')->group(function () {
        Route::get('/calendar', [CalendarController::class, 'index']);
        Route::patch('/calendar/{calendar}', [CalendarController::class, 'update']);
        Route::delete('/calendar/{calendar}', [CalendarController::class, 'destroy']);
    });

});

Route::prefix('v1')->group(function () {
    Route::post('/calendar', [CalendarController::class, 'store']);
});
