<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WorkforceController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;


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


// Scheduling Routes
Route::get('/admin/scheduling', [SchedulingController::class, 'index'])->name('scheduling');
Route::get('/scheduling', [SchedulingController::class, 'index'])->name('scheduling.index');
Route::post('/scheduling', [SchedulingController::class, 'store'])->name('scheduling.store');


// Others

Route::get('/clients', [ClientController::class, 'index'])->name('clients');

Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
Route::post('/scheduling/store', [SchedulingController::class, 'store'])->name('scheduling.store');
Route::resource('employees', EmployeeController::class);
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
// routes/web.php
Route::get('admin/services', [ServiceController::class, 'index'])->name('admin.services');
Route::get('appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('appointments/{id}/notify-client', [AppointmentController::class, 'notifyClient'])->name('appointments.notifyClient');
Route::get('appointments/{id}/notify-employee', [AppointmentController::class, 'notifyEmployee'])->name('appointments.notifyEmployee');
Route::delete('appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');


//Appointments function Controllers

Route::prefix('admin')->name('appointments.')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('store');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('show');
    Route::get('/appointments/{id}/notify-client', [AppointmentController::class, 'notifyClient'])->name('notifyClient');
    Route::get('/appointments/{id}/notify-employee', [AppointmentController::class, 'notifyEmployee'])->name('notifyEmployee');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('destroy');
});


//Inventory
Route::get('/admin/inventory', [InventoryController::class, 'index'])->name('inventory');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::put('/inventory/{product}', [InventoryController::class, 'update'])->name('inventory.update');
Route::patch('/inventory/{product}/restock', [InventoryController::class, 'restock'])->name('inventory.restock');
Route::delete('/inventory/{product}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

//WorkForce

Route::prefix('admin')->group(function () {
    Route::get('/workforce', [WorkforceController::class, 'index'])->name('workforce.index');
    Route::post('/workforce', [WorkforceController::class, 'store'])->name('workforce.store');
    Route::put('/workforce/{id}', [WorkforceController::class, 'update'])->name('workforce.update');
    Route::patch('/workforce/{id}/status', [WorkforceController::class, 'changeStatus'])->name('workforce.changeStatus');
    Route::delete('/workforce/{id}', [WorkforceController::class, 'destroy'])->name('workforce.destroy');
});


// routes/web.php
Route::resource('supplier', SupplierController::class);
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');

//Workforce

Route::prefix('admin')->group(function () {
    Route::get('/workforce', [WorkforceController::class, 'index'])->name('workforce.index');
    Route::post('/workforce', [WorkforceController::class, 'store'])->name('workforce.store');
    Route::put('/workforce/{id}', [WorkforceController::class, 'update'])->name('workforce.update');
    Route::delete('/workforce/{id}', [WorkforceController::class, 'destroy'])->name('workforce.destroy');
    Route::patch('/workforce/{id}/status', [WorkforceController::class, 'changeStatus'])->name('workforce.changeStatus');
});

//Analytics
 Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');
});


//Reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports'); // route('reports')

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index'); // route('admin.reports.index')
    Route::get('reports/export/{type}', [ReportController::class, 'export'])->name('reports.export');
});
