<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\SAWController;
use App\Http\Controllers\SMARTController;
use App\Http\Controllers\views\DashboardController;
use App\Http\Controllers\views\FamilyInformationController;
use App\Http\Controllers\views\FamilyMemberInformationController;
use App\Http\Controllers\views\LetterController;
use App\Http\Controllers\views\ManageCitizens;
use App\Http\Controllers\views\ManageHistoryController;
use App\Http\Controllers\views\ManageZakatController;
use App\Http\Controllers\views\ManageLetterArchivesController;
use App\Http\Controllers\RTController;
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
Route::get('/', [\App\Http\Controllers\views\LandingPageController::class, 'index'])->name('landing-page');

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/penduduk', [ManageCitizens::class, 'index'])->name('penduduk')->middleware('can:manager');
	Route::get('/history', [ManageHistoryController::class, 'index'])->name('history')->middleware('can:manager');
	Route::get('letter-archives', [ManageLetterArchivesController::class, 'index'])->name('letter-archives')->middleware('can:admin');

	Route::prefix('/tab-content/')->group(function () {
		Route::resource('family-heads', FamilyController::class);
		Route::get('family-heads/pecah/{family_head}', [FamilyController::class, 'create'])->name('family-heads.pecah');
		Route::delete('family-heads/{family_head}', [FamilyController::class, 'softDeleteAndAddToHistory'])->name('family-heads.destroy');
		Route::put('family-heads/upload/{family_head}', [FamilyController::class, 'upload'])->name('family-heads.upload');
		Route::resource('citizens', CitizenController::class);
		Route::delete('citizens/{citizen}', [CitizenController::class, 'softDeleteAndAddToHistory'])->name('citizens.destroy');
		Route::put('citizens/upload/{citizen}', [CitizenController::class, 'upload'])->name('citizens.upload');
		Route::get('citizens/restore/{citizen}', [CitizenController::class, 'restore'])->name('citizens.restore');
		Route::get('citizens-history', [ManageHistoryController::class, 'citizen'])->name('citizens-history.index');
		Route::get('citizens-history/download/{id}', [CitizenController::class, 'download'])->name('citizens-history.download');
		Route::get('saw', [ManageZakatController::class, 'saw'])->name('saw.index');
		Route::get('smart', [ManageZakatController::class, 'smart'])->name('smart.index');
		Route::get('family-history', [ManageHistoryController::class, 'family'])->name('family-history.index');
		Route::get('family-history/download/{id}', [FamilyController::class, 'download'])->name('family-history.download');
		Route::get('family-history/restore/{family_head}', [FamilyController::class, 'restore'])->name('family-history.restore');
	});

	Route::resource('/informasi-keluarga', FamilyInformationController::class)->middleware('can:user');

	Route::resource('/letter', LetterController::class)->middleware('can:user');

	Route::prefix('/settings')->group(function () {
		Route::get('/', [AuthController::class, 'settings'])->name('settings');
		Route::put('/', [AuthController::class, 'updatePassword'])->name('auth.update.password');
		Route::put('/username', [AuthController::class, 'updateUsername'])->name('auth.update.username')->middleware('can:user');
		Route::get('/reset-password/{id}', [AuthController::class, 'resetPassword'])->name('auth.reset.password')->middleware('can:admin');
		Route::put('/ketuart', [RTController::class, 'updateKetuaRT'])->name('rt.update.ketuart')->middleware('can:manager');
	});

	Route::prefix('/zakat')->group(function () {
		Route::get('/', [ManageZakatController::class, 'index'])->name('zakat.index');
		Route::post('/', [ManageZakatController::class, 'store'])->name('zakat.store');
		Route::get('saw', [SAWController::class, 'index'])->name('saw');
		Route::get('saw/export-pdf', [ManageZakatController::class, 'exportSAWPdf'])->name('saw.export.pdf');
		Route::get('smart/export-pdf', [ManageZakatController::class, 'exportSMARTPdf'])->name('smart.export.pdf');
		Route::get('saw/next', [SAWController::class, 'nextStep'])->name('nextSawStep');
		Route::get('saw/prev', [SAWController::class, 'previousStep'])->name('prevSawStep');
		Route::get('saw/step/{step}', [SAWController::class, 'changeStep'])->name('changeSawStep');
		Route::get('smart', [SMARTController::class, 'index'])->name('smart');
		Route::get('smart/next', [SMARTController::class, 'nextStep'])->name('nextSmartStep');
		Route::get('smart/prev', [SMARTController::class, 'previousStep'])->name('prevSmartStep');
		Route::get('smart/step/{step}', [SMARTController::class, 'changeStep'])->name('changeSmartStep');

	})->middleware('can:amil');


	Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities')->middleware('can:manager');
	Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts')->middleware('can:manager');
	Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages')->middleware('can:manager');
	Route::get('citizens', [DependantDropdownController::class, 'citizens'])->name('citizens');

	Route::get('/family', [FamilyMemberInformationController::class, 'index'])->name('family')->middleware('can:user');
});
