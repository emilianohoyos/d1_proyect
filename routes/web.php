<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteScheduleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {

	Route::resource('employee', EmployeeController::class);
	Route::resource('store', StoreController::class);
	Route::get('store/download-qr/{id}', [StoreController::class, 'downloadQR'])->name('store.downloadQR');
	Route::post('store/toggle-status/{id}', [StoreController::class, 'toggleStatus'])->name('store.toggle-status');
	Route::resource('route', RouteController::class);
	Route::get('route/{id}/stores', [RouteController::class, 'stores'])->name('route.stores');
	Route::post('route/{id}/stores', [RouteController::class, 'addStores'])->name('route.add-stores');
	Route::delete('route/{route}/store/{store}', [RouteController::class, 'removeStore'])->name('route.remove-store');

	// Rutas para el calendario (deben ir antes de las rutas de schedule)
	Route::get('route/schedules/list', [RouteController::class, 'getSchedules'])->name('route.schedules');
	Route::delete('route/schedule/delete/{id}', [RouteController::class, 'destroySchedule'])->name('route.schedule.destroy');

	Route::get('route-schedule/create', [RouteScheduleController::class, 'create'])->name('route.schedule.create');
	Route::post('route-schedule', [RouteScheduleController::class, 'store'])->name('route.schedule.store');
	Route::get('route-schedule/search', [RouteScheduleController::class, 'search'])->name('route.schedule.search');
	Route::get('route-schedule/results', [RouteScheduleController::class, 'results'])->name('route.schedule.results');
	Route::get('route/schedule/{id}/edit', [RouteController::class, 'editSchedule'])->name('route.schedule.edit');
	Route::put('route/schedule/{id}', [RouteController::class, 'updateSchedule'])->name('route.schedule.update');

	Route::get('route/schedule/day/{date}', [RouteScheduleController::class, 'day'])->name('route.schedule.day');

	Route::get('/', function () {
		return view('home');
	})->name('home');
});

// Profile Routes
Route::middleware(['auth'])->group(function () {
	Route::get('/profile', function () {
		return view('pages.profile');
	})->name('profile');

	Route::put('/profile', function () {
		$validated = request()->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
		]);

		Auth::user()->update($validated);

		return redirect()->route('profile')->with('success', 'Profile updated successfully.');
	})->name('profile.update');

	Route::get('/settings', function () {
		return view('pages.settings');
	})->name('settings');

	Route::put('/settings', function () {
		$validated = request()->validate([
			'current_password' => ['required', 'current_password'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);

		Auth::user()->update([
			'password' => Hash::make($validated['password']),
		]);

		return redirect()->route('settings')->with('success', 'Password updated successfully.');
	})->name('settings.update');
});
