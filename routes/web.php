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
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ClientProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\PasswordController;



Route::get('/', function () {
    return view('web.index');
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
Route::put('/profile/update', [ProfileController::class, 'update']);

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

// Scheduling Routes
Route::get('/admin/scheduling', [SchedulingController::class, 'index'])->name('scheduling');
Route::get('/scheduling', [SchedulingController::class, 'index'])->name('scheduling.index');
Route::post('/scheduling', [SchedulingController::class, 'store'])->name('scheduling.store');


// Clients Routes
Route::get('/clients', [ClientController::class, 'index'])->name('clients');
Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');

//
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
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');


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
// Example route definition
Route::get('/workforce', [WorkforceController::class, 'index'])->name('workforce');


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
Route::get('/transactions/export', [ReportController::class, 'exportExcel'])->name('transactions.export');
Route::get('/transactions/export', [TransactionController::class, 'exportExcel'])->name('transactions.export');
Route::resource('transactions', TransactionController::class);

//Transactions
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index'); // route('admin.reports.index')
    Route::get('reports/export/{type}', [ReportController::class, 'export'])->name('reports.export');
});
Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
// fallback route without prefix
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');


//Mails
Route::get('/compose', function () {
    return view('admin.compose'); // adjust view path if needed
})->name('compose');

Route::get('/inbox', function () {
    return view('admin.inbox'); // adjust view path if needed
})->name('inbox');

Route::get('/sent', function () {
    return view('admin.sent'); // adjust view path if needed
})->name('sent');

Route::get('/drafts', function () {
    return view('admin.drafts'); // adjust view path if needed
})->name('drafts');

Route::get('/chats', function () {
    return view('admin.chats'); // adjust view path if needed
})->name('chats');

Route::get('/all_mails', function () {
    return view('admin.all_mails'); // adjust view path if needed
})->name('all_mails');

Route::get('/trash', function () {
    return view('admin.trash'); // adjust view path if needed
})->name('trash');

Route::get('/meetings', function () {
    return view('admin.meetings'); // adjust view path if needed
})->name('meetings');

Route::get('/whatsapp', function () {
    return view('admin.whatsapp'); // adjust view path if needed
})->name('whatsapp');



//Cient-Product
Route::prefix('admin')->group(function () {
    Route::get('/client-products', [ClientProductController::class, 'index'])->name('client-products.index');
    Route::get('/client-products/create', [ClientProductController::class, 'create'])->name('client-products.create');
    Route::post('/client-products/store', [ClientProductController::class, 'store'])->name('client-products.store');
    Route::get('/client-products/{id}', [ClientProductController::class, 'show'])->name('client-products.show');
    Route::get('/client-products/{id}/edit', [ClientProductController::class, 'edit'])->name('client-products.edit');
    Route::put('/client-products/{id}', [ClientProductController::class, 'update'])->name('client-products.update');
    Route::delete('/client-products/{id}', [ClientProductController::class, 'destroy'])->name('client-products.destroy');
});

Route::post('/admin/client-product/store', [ClientProductController::class, 'store'])->name('client-product.store');

//Settings

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('admin.settings.update');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/workforce', [WorkforceController::class, 'index'])->name('workforce');
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/workforce', [WorkforceController::class, 'index'])->name('workforce');
});


//
Route::post('/appointments/notify-client', [App\Http\Controllers\AppointmentController::class, 'notifyClient'])->name('appointments.notify.client');
Route::post('/appointments/notify-employee', [App\Http\Controllers\AppointmentController::class, 'notifyEmployee'])->name('appointments.notify.employee');


//Mails
Route::post('/admin/emails/send', [EmailController::class, 'sendEmail'])->name('emails.send');
Route::post('/emails/send', [EmailController::class, 'send'])->name('emails.send')->middleware('auth');


//
Route::get('/reports/export/{type}', [ReportController::class, 'export'])->name('reports.export');


//Register
Route::get('/auth/register', [RegisteredUserController::class, 'create'])->name('auth.register');
Route::post('/auth/register', [RegisteredUserController::class, 'store']);
// Login routes (needed to avoid auth.login missing route error)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

//Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
// In routes/web.php
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


//Appointment
Route::get('/web/appointment', [AppointmentController::class, 'create'])->name('web.appointment');
Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.form');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');


//Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


//Pass
// Example GET route for showing the password change form
Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');

// Example POST route for processing the password change
Route::post('/password/change', [PasswordController::class, 'update'])->name('password.change.update');
Route::middleware(['auth'])->group(function () {
    Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');
});
