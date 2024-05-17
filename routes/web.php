<?php

use App\Http\Controllers\TabController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageCitizens;

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

Route::resource('/penduduk', ManageCitizens::class)->names([
	'index' => 'penduduk.index',
	'create' => 'penduduk.create',
	'store' => 'penduduk.store',
	'show' => 'penduduk.show',
	'edit' => 'penduduk.edit',
	'update' => 'penduduk.update',
	'destroy' => 'penduduk.destroy',
]);
Route::get('/riwayat', [\App\Http\Controllers\historyCitizensController::class, 'index'])->name('history');

Route::get('/tab-content/{tabId}', [TabController::class, 'getTabContent']);
