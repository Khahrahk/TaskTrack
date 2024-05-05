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

    Route::prefix('projects')->as('projects.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProjectController::class, 'index'])->name('index');;
        Route::get('/{id}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('show');
    });

    Route::get('/issues', [\App\Http\Controllers\IssueController::class, 'index'])->name('issues');

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

Route::get('manifest.json', \App\Http\Controllers\WebmanifestController::class)->name('webmanifest');
