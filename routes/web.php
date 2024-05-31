<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;

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

Route::get('/', [PageController::class, 'index'] )->name('home');

Route::middleware(['auth', 'verified'])
      ->name('admin.')
      ->prefix('admin')
      ->group(function(){
        // Rotte get
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

        // Rotte CRUD
        Route::resource('/projects', ProjectController::class);
        Route::resource('/technologies', TechnologyController::class)->except('create', 'edit', 'show');
        Route::resource('/types', TypeController::class)->except('create', 'edit');

        // Rotte CRUD Custom
        Route::get('/types-projects/', [TypeController::class, 'typesProjects'])->name('types-projects');
        Route::get('/technologies-projects/', [TechnologyController::class, 'technologiesProjects'])->name('technologies-projects');
        Route::get('/order-by/{col}/{dir}', [ProjectController::class, 'orderBy'])->name('order-by');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
