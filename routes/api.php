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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::get('projects', [\App\Http\Controllers\ProjectController::class, 'projectList'])->name('project.list');
    Route::prefix('projects')->as('projects.')->group(function () {
        Route::get('list', [\App\Http\Controllers\ProjectController::class, 'projectList'])->name('list');
        Route::post('update', [\App\Http\Controllers\ProjectController::class, 'update'])->name('update');
        Route::post('store', [\App\Http\Controllers\ProjectController::class, 'store'])->name('store');
        Route::post('delete', [\App\Http\Controllers\ProjectController::class, 'delete'])->name('delete');
    });
    Route::prefix('issues')->as('issues.')->group(function () {
        Route::get('list', [\App\Http\Controllers\IssueController::class, 'issueList'])->name('list');
        Route::post('update', [\App\Http\Controllers\IssueController::class, 'update'])->name('update');
        Route::post('store', [\App\Http\Controllers\IssueController::class, 'store'])->name('store');
        Route::post('delete', [\App\Http\Controllers\IssueController::class, 'delete'])->name('delete');
    });
    Route::get('issues', [\App\Http\Controllers\IssueController::class, 'issueList'])->name('issue.list');
});
