<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\MustahikSubmissionController;
use App\Http\Controllers\views\CitizensHistoryController;
use App\Http\Controllers\views\DashboardController;
use App\Http\Controllers\views\FamilyHistoryController;
use App\Http\Controllers\views\FamilyInformationController;
use App\Http\Controllers\views\LetterController;
use App\Http\Controllers\views\ManageCitizens;
use App\Http\Controllers\views\ManageHistoryController;
use Illuminate\Support\Facades\Auth;
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
	return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/penduduk', [ManageCitizens::class, 'index'])->name('penduduk')->middleware('can:manager');
	Route::get('/history', [ManageHistoryController::class, 'index'])->name('history')->middleware('can:manager');

	Route::prefix('/tab-content/')->group(function () {
		Route::resource('/family-heads', FamilyController::class);
		Route::delete('family-heads/{family_head}', [FamilyController::class, 'softDeleteAndAddToHistory'])->name('family-heads.destroy');
		Route::resource('citizens', CitizenController::class);
		Route::get('citizens-history', [ManageHistoryController::class, 'citizen'])->name('citizens-history.index');
		Route::get('family-history', [ManageHistoryController::class, 'family'])->name('family-history.index');
		Route::get('family-history/download/{id}', [ManageHistoryController::class, 'download'])->name('family-history.download');
	});


	Route::resource('/letter', LetterController::class);

	Route::resource('/submission', MustahikSubmissionController::class);
	Route::get('/settings', [AuthController::class, 'settings'])->name('settings');
	Route::post('/settings', [AuthController::class, 'updatePassword'])->name('auth.update.password');
	Route::post('/settings/username', [AuthController::class, 'updateUsername'])->name('auth.update.username');

	Route::resource('zakat', \App\Http\Controllers\views\ManageZakatController::class);

	Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities')->middleware('can:manager');
	Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts')->middleware('can:manager');
	Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages')->middleware('can:manager');

	Route::get('/family', [FamilyInformationController::class, 'index'])->name('family')->middleware('can:user');
});
