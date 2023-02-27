<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Programs\ProgramsController;
use App\Http\Controllers\V1\Programs\ProgramReportsController;
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
Route::group([
    'middleware' => 'api'
], function ($router) {

    /**
     * Authentication Module
     */
    Route::group(['prefix' => 'auth'], function() {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    /**
     * Programs Module
     */
    Route::resource('programs', ProgramsController::class);
    Route::get('programs/view/all', [ProgramsController::class, 'indexAll']);
    Route::get('programs/view/search', [ProgramsController::class, 'search']);

    /**
     * Program Reports Module
     */
    Route::resource('reports', ProgramReportsController::class);
    Route::get('reports/view/all', [ProgramReportsController::class, 'indexAll']);
    Route::get('reports/view/search', [ProgramReportsController::class, 'search']);
});

