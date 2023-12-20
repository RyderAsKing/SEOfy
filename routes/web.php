<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );

    Route::get('/projects', [
        App\Http\Controllers\ProjectController::class,
        'index',
    ])->name('projects.index');

    Route::get('/projects/{project}/show', [
        App\Http\Controllers\ProjectController::class,
        'show',
    ])->name('projects.show');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('plans', PlanController::class);
        Route::resource('projects', ProjectController::class);

        // timeline routes
        Route::get('/projects/{project}/timelines/create', [
            ProjectController::class,
            'timeline_create',
        ])->name('projects.timeline.create');

        Route::post('/projects/{project}/timelines', [
            ProjectController::class,
            'timeline_store',
        ])->name('projects.timeline.store');

        Route::get('/projects/{project}/timelines/{timeline_id}/edit', [
            ProjectController::class,
            'timeline_edit',
        ])->name('projects.timeline.edit');

        Route::patch('/projects/{project}/timelines/{timeline_id}', [
            ProjectController::class,
            'timeline_update',
        ])->name('projects.timeline.update');

        Route::delete('/projects/{project}/timelines/{timeline_id}', [
            ProjectController::class,
            'timeline_destroy',
        ])->name('projects.timeline.destroy');

        Route::get('/users/{user}/impersonate', [
            UserController::class,
            'impersonate',
        ])->name('users.impersonate');
    });

Route::impersonate();

require __DIR__ . '/auth.php';
