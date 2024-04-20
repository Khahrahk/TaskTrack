<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:web')->group(function () {
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/', fn(Request $request) => $request->user());
    });
    Route::get('projects', [\App\Http\Controllers\ProjectController::class, 'projectList'])->name('project.list');
//});
