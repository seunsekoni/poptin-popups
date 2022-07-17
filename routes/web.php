<?php

use App\Http\Controllers\User\DomainController;
use App\Http\Controllers\User\PopupController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'login');

Route::prefix('/domains')->group(function () {
    Route::get('/', [DomainController::class, 'index'])->name('domains.index');
    Route::get('/create', [DomainController::class, 'create'])->name('domains.create');
    Route::post('/store', [DomainController::class, 'store'])->name('domains.store');

    Route::prefix('/{domain}')->group(function () {
        Route::get('/', [DomainController::class, 'show'])->name('domains.show');
        Route::get('/edit', [DomainController::class, 'edit'])->name('domains.edit');
        Route::put('/update', [DomainController::class, 'update'])->name('domains.update');
        Route::delete('/destroy', [DomainController::class, 'destroy'])->name('domains.destroy');

        Route::prefix('/popups')->group(function () {
            Route::get('/', [PopupController::class, 'index'])->name('popups.index');
            Route::get('/create', [PopupController::class, 'create'])->name('popups.create');
            Route::post('/store', [PopupController::class, 'store'])->name('popups.store');

            Route::prefix('/{popup}')->group(function () {
                Route::get('/', [PopupController::class, 'show'])->name('popups.show');
                Route::get('/edit', [PopupController::class, 'edit'])->name('popups.edit');
                Route::put('/update', [PopupController::class, 'update'])->name('popups.update');
                Route::delete('/destroy', [PopupController::class, 'destroy'])->name('popups.destroy');
            });
        });
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
