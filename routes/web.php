<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->middleware('guest');

Route::middleware("auth:web")->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::get('/workspaces', [\App\Http\Controllers\WorkspaceController::class, 'index'])->name('workspaces');
    Route::post('/workspace_create', [\App\Http\Controllers\WorkspaceController::class, 'create'])->name('workspace_create');
    Route::post('/workspace_join', [\App\Http\Controllers\WorkspaceController::class, 'join'])->name('workspace_join');

    Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects');
    Route::post('/project_create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('project_create');

    Route::get('/issues', [\App\Http\Controllers\IssueController::class, 'index'])->name('issues');
    Route::post('/issue_create', [\App\Http\Controllers\IssueController::class, 'create'])->name('issue_create');
    Route::post('/issue_archive', [\App\Http\Controllers\IssueController::class, 'archive'])->name('issue_archive');
    Route::post('/issue_delete', [\App\Http\Controllers\IssueController::class, 'delete'])->name('issue_delete');

    Route::get('/agiles', [\App\Http\Controllers\AgileController::class, 'index'])->name('agiles');
});

Route::middleware("guest:web")->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');

    Route::get('/forgot', [\App\Http\Controllers\AuthController::class, 'showForgotForm'])->name('forgot');
    Route::post('/forgot_process', [\App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot_process');
});
