<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
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

Route::get('/', function () {
    return redirect("/login");
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/open-tickets', [DashboardController::class, 'openTickets'])->name('dashboard.open_tickets');
    Route::get('/dashboard', [DashboardController::class, 'generalUserDashboard'])->name('dashboard');
    Route::post('/services/{service}/apply', [ServiceController::class, 'applyForService'])->name('services.apply');
    Route::delete('/services/applications/{service}', [ServiceController::class, 'deleteApplication'])->name('services.applications.delete');
});

Route::middleware('adminAuth')->prefix('admin')->group(function () {
    Route::get('admin/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('services/{service}/edit', [ServiceController::class, 'editService'])->name('services.edit');
    Route::put('services/{service}', [ServiceController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');

    Route::get('categories', [ServiceCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [ServiceCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [ServiceCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{category}/edit', [ServiceCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{category}', [ServiceCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{category}', [ServiceCategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

require __DIR__ . '/auth.php';
