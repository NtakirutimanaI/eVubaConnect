<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('admin.index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('profile.uploadImage');

});

require __DIR__.'/auth.php';
//Users Routes
Route::get('admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::get('manager/dashboard', [HomeController::class, 'manager'])->name('manager.dashboard')->middleware(['auth', 'manager']);
Route::get('agent/dashboard', [HomeController::class, 'agent'])->name('agent.dashboard')->middleware(['auth', 'agent']);
Route::get('customer/dashboard', [HomeController::class, 'customer'])->name('customer.dashboard')->middleware(['auth', 'customer']);
Route::get('support/dashboard', [HomeController::class, 'support'])->name('support.dashboard')->middleware(['auth', 'support']);
Route::get('inventory/dashboard', [HomeController::class, 'inventory'])->name('inventory.dashboard')->middleware(['auth', 'inventory']);
Route::get('hr/dashboard', [HomeController::class, 'hr'])->name('hr.dashboard')->middleware(['auth', 'hr']);
Route::get('analyst/dashboard', [HomeController::class, 'analyst'])->name('analyst.dashboard')->middleware(['auth', 'analyst']);
Route::get('technician/dashboard', [HomeController::class, 'technician'])->name('technician.dashboard')->middleware(['auth', 'technician']);
Route::get('ai/dashboard', [HomeController::class, 'ai'])->name('ai.dashboard')->middleware(['auth', 'ai']);

Route::get('/', function () {
    return view('admin.index');
})->name('dashboard');
