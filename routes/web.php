<?php

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

Route::get('/', function () {
	return view('layouts.app');
});

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
Route::get('/penduduk/riwayat', [\App\Http\Controllers\historyCitizensController::class, 'index'])->name('history');
