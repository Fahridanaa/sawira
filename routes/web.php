<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageCitizens;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\FamilyHeadController;
use App\Http\Controllers\DependantDropdownController;

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

Route::redirect('/', '/login');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/penduduk', [ManageCitizens::class, 'index'])->name('penduduk.index');
Route::get('/history', [\App\Http\Controllers\historyCitizensController::class, 'index'])->name('history');

Route::get('/tab-content/family-heads', [FamilyHeadController::class, 'index'])->name('family-heads.index');
Route::get('/family-heads/create', [FamilyHeadController::class, 'create'])->name('family-heads.create');
Route::get('/family-heads/{id}', [FamilyHeadController::class, 'show'])->name('family-heads.show');
Route::get('/tab-content/citizens', [CitizenController::class, 'index'])->name('citizen.index');
Route::get('/citizen/create', [CitizenController::class, 'create'])->name('citizen.create');


Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');
