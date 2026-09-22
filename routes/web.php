<?php

use App\Http\Controllers\ActivationController;
use App\Http\Controllers\Admin\ResidentActivationController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\HouseController;
use App\Http\Controllers\Admin\HouseholdController;
use App\Http\Controllers\Admin\HouseMapController;
use App\Http\Controllers\Admin\GuestLocationLinkController;
use App\Http\Controllers\GuestLocationController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('home');
Route::view('/auth-preview', 'auth-preview')->name('auth-preview');
Route::get('/guest/location/{token}', [GuestLocationController::class, 'show'])->middleware('throttle:guest-location')->name('guest.location.show');

Route::middleware(['guest', 'throttle:activation'])->group(function () {
    Route::get('/activate', [ActivationController::class, 'create'])->name('activation.create');
    Route::post('/activate', [ActivationController::class, 'validateCode'])->name('activation.validate');
    Route::get('/activate/account', [ActivationController::class, 'accountForm'])->name('activation.account.create');
    Route::post('/activate/account', [ActivationController::class, 'storeAccount'])->name('activation.account.store');
});

Route::middleware(['auth', 'verified', 'account.active', 'role:super_admin,admin_rt', 'tenant.context'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::redirect('warga', 'admin/residents')->name('warga.index');
    Route::view('/design-system', 'design-system')->name('design-system');
    Route::view('/error-preview', 'error-preview')->name('error-preview');
    Route::get('/admin/residents/{resident}/activation', [ResidentActivationController::class, 'show'])->name('admin.residents.activation.show');
    Route::post('/admin/residents/{resident}/activation', [ResidentActivationController::class, 'store'])->name('admin.residents.activation.store');
    Route::delete('/admin/residents/{resident}/activation/{activationCode}', [ResidentActivationController::class, 'destroy'])->name('admin.residents.activation.destroy');
    Route::patch('/admin/residents/{resident}/status', [ResidentController::class, 'status'])->name('admin.residents.status');
    Route::resource('/admin/residents', ResidentController::class)->names('admin.residents')->except('destroy');
    Route::resource('/admin/houses', HouseController::class)->names('admin.houses')->except('destroy');
    Route::get('/admin/houses-map', [HouseMapController::class, 'index'])->name('admin.houses.map');
    Route::post('/admin/houses/{house}/guest-links', [GuestLocationLinkController::class, 'store'])->name('admin.houses.guest-links.store');
    Route::delete('/admin/houses/{house}/guest-links/{guestLocationLink}', [GuestLocationLinkController::class, 'destroy'])->name('admin.houses.guest-links.destroy');
    Route::resource('/admin/households', HouseholdController::class)->names('admin.households')->except('destroy');
    Route::post('/admin/households/{household}/members', [HouseholdController::class, 'addMember'])->name('admin.households.members.store');
    Route::patch('/admin/households/{household}/members/{member}/end', [HouseholdController::class, 'endMember'])->name('admin.households.members.end');
});

require __DIR__.'/settings.php';
