<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**General user routes **/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/open-tickets', [DashboardController::class, 'openTickets'])->name('dashboard.open_tickets');
    Route::get('/dashboard', [DashboardController::class, 'generalUserDashboard'])->name('dashboard');
    Route::post('/services/{serviceId}/apply', [ServiceController::class, 'applyForService'])->name('services.apply');
});

/**Admin routes **/
Route::middleware('adminAuth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('adminDashboardShow');
});



require __DIR__ . '/auth.php';
