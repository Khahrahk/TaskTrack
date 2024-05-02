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
    Route::get('issues', [\App\Http\Controllers\IssueController::class, 'issueList'])->name('issue.list');
});
