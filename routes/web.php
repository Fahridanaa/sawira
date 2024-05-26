<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageHistoryController;
use App\Http\Controllers\ManageCitizens;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\FamilyHeadController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CitizensHistoryController;
use App\Http\Controllers\MoveHistoryController;
use App\Http\Controllers\AuthController;

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
	return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/penduduk', [ManageCitizens::class, 'index'])->name('penduduk.index')->middleware('can:manage-citizens');
	Route::get('/history', [ManageHistoryController::class, 'index'])->name('history');
	Route::get('/tab-content/citizens-history', [CitizensHistoryController::class, 'index'])->name('citizens-history.index');
	Route::get('/tab-content/move-history', [MoveHistoryController::class, 'index'])->name('move-history.index');
	Route::get('/tab-content/family-heads', [FamilyHeadController::class, 'index'])->name('family-heads.index');
	Route::get('/family-heads/create', [FamilyHeadController::class, 'create'])->name('family-heads.create');
	Route::get('/family-heads/{id}', [FamilyHeadController::class, 'show'])->name('family-heads.show');
	Route::get('/tab-content/citizens', [CitizenController::class, 'index'])->name('citizen.index');
	Route::get('/citizen/create', [CitizenController::class, 'create'])->name('citizen.create');
	Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
	Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
	Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');
});
