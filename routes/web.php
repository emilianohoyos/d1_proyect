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

	Route::get('/', function () {
		return view('home');
	})->name('home');

	Route::get('/analytics', function () {
		return view('/pages/analytics');
	});

	Route::get('/email/inbox', function () {
		return view('/pages/email-inbox');
	});

	Route::get('/email/compose', function () {
		return view('/pages/email-compose');
	});

	Route::get('/email/detail', function () {
		return view('/pages/email-detail');
	});

	Route::get('/widgets', function () {
		return view('/pages/widgets');
	});

	Route::get('/pos/customer-order', function () {
		return view('/pages/pos-customer-order');
	});

	Route::get('/pos/kitchen-order', function () {
		return view('/pages/pos-kitchen-order');
	});

	Route::get('/pos/counter-checkout', function () {
		return view('/pages/pos-counter-checkout');
	});

	Route::get('/pos/table-booking', function () {
		return view('/pages/pos-table-booking');
	});

	Route::get('/pos/menu-stock', function () {
		return view('/pages/pos-menu-stock');
	});

	Route::get('/ui/bootstrap', function () {
		return view('/pages/ui-bootstrap');
	});

	Route::get('/ui/buttons', function () {
		return view('/pages/ui-buttons');
	});

	Route::get('/ui/card', function () {
		return view('/pages/ui-card');
	});

	Route::get('/ui/icons', function () {
		return view('/pages/ui-icons');
	});

	Route::get('/ui/modal-notifications', function () {
		return view('/pages/ui-modal-notifications');
	});

	Route::get('/ui/typography', function () {
		return view('/pages/ui-typography');
	});

	Route::get('/ui/tabs-accordions', function () {
		return view('/pages/ui-tabs-accordions');
	});

	Route::get('/form/elements', function () {
		return view('/pages/form-elements');
	});

	Route::get('/form/plugins', function () {
		return view('/pages/form-plugins');
	});

	Route::get('/form/wizards', function () {
		return view('/pages/form-wizards');
	});

	Route::get('/table/elements', function () {
		return view('/pages/table-elements');
	});

	Route::get('/table/plugins', function () {
		return view('/pages/table-plugins');
	});

	Route::get('/chart/chart-js', function () {
		return view('/pages/chart-js');
	});

	Route::get('/chart/chart-apex', function () {
		return view('/pages/chart-apex');
	});

	Route::get('/map', function () {
		return view('/pages/map');
	});

	Route::get('/layout/starter-page', function () {
		return view('/pages/layout-starter-page');
	});

	Route::get('/layout/fixed-footer', function () {
		return view('/pages/layout-fixed-footer');
	});

	Route::get('/layout/full-height', function () {
		return view('/pages/layout-full-height');
	});

	Route::get('/layout/full-width', function () {
		return view('/pages/layout-full-width');
	});

	Route::get('/layout/boxed-layout', function () {
		return view('/pages/layout-boxed-layout');
	});

	Route::get('/layout/minified-sidebar', function () {
		return view('/pages/layout-minified-sidebar');
	});

	Route::get('/layout/top-nav', function () {
		return view('/pages/layout-top-nav');
	});

	Route::get('/layout/mixed-nav', function () {
		return view('/pages/layout-mixed-nav');
	});

	Route::get('/layout/mixed-nav-boxed-layout', function () {
		return view('/pages/layout-mixed-nav-boxed-layout');
	});

	Route::get('/page/scrum-board', function () {
		return view('/pages/page-scrum-board');
	});

	Route::get('/page/products', function () {
		return view('/pages/page-products');
	});

	Route::get('/page/product/details', function () {
		return view('/pages/page-product-details');
	});

	Route::get('/page/orders', function () {
		return view('/pages/page-orders');
	});

	Route::get('/page/order/details', function () {
		return view('/pages/page-order-details');
	});

	Route::get('/page/gallery', function () {
		return view('/pages/page-gallery');
	});

	Route::get('/page/search-results', function () {
		return view('/pages/page-search-results');
	});

	Route::get('/page/coming-soon', function () {
		return view('/pages/page-coming-soon');
	});

	Route::get('/page/error', function () {
		return view('/pages/page-error');
	});

	Route::get('/page/login', function () {
		return view('/pages/page-login');
	});

	Route::get('/page/register', function () {
		return view('/pages/page-register');
	});

	Route::get('/page/messenger', function () {
		return view('/pages/page-messenger');
	});

	Route::get('/page/data-management', function () {
		return view('/pages/page-data-management');
	});

	Route::get('/page/file-manager', function () {
		return view('/pages/page-file-manager');
	});

	Route::get('/page/pricing', function () {
		return view('/pages/page-pricing');
	});

	Route::get('/landing', function () {
		return view('/pages/landing');
	});

	Route::get('/profile', function () {
		return view('/pages/profile');
	});

	Route::get('/calendar', function () {
		return view('/pages/calendar');
	});

	Route::get('/settings', function () {
		return view('/pages/settings');
	});

	Route::get('/helper', function () {
		return view('/pages/helper');
	});
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
