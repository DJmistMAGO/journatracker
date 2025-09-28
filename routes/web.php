<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\PubManagementController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\ArticleManagementController;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\EditorialSchedulingController;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\FilterCategoryController;
use App\Http\Controllers\NotificationController;

// welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/category/{category}', [FilterCategoryController::class, 'viewCategory'])->name('category.view');
Route::get('/read-article/{type}/{id}', [FilterCategoryController::class, 'showContent'])->name('article.read');

Route::controller(IncidentReportController::class)
        ->prefix('incident-report')
        ->group(function () {
            Route::get('/', 'index')->name('incident-report');
            Route::post('/store-report', 'storeReport')->name('incident-report.store-report');
			Route::get('/show/{id}','show')->name('incident-report.show');
			Route::put('/update-status/{id}','updateStatus')->name('incident-report.update-status');
        });

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginBasic::class, 'index'])->name('login');
    Route::post('/login', [LoginBasic::class, 'authenticate'])->name('login.post');

    Route::get('/register', [RegisterBasic::class, 'index'])->name('register');
    Route::post('/register', [RegisterBasic::class, 'store'])->name('register.post');

    Route::get('/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordBasic::class, 'sendResetLink'])->name('forgot-password.post');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
    Route::post('/logout', [LoginBasic::class, 'logout'])->name('logout');

	Route::post('/notifications/mark-read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
	Route::post('/notifications/{id}/read', [NotificationController::class, 'markSingleRead'])->name('notifications.markSingleRead');


    Route::controller(PubManagementController::class)
        ->prefix('publication')
        ->group(function () {
            Route::get('/', 'index')->name('publication-management.index');
            Route::get('show/{type}/{id}', 'show')->name('publication-management.show');
            Route::put('update-status/{type}/{id}', 'updateStatus')->name('publication-management.update-status');
        });

    Route::controller(ArticleManagementController::class)
        ->prefix('article-management')
        ->group(function () {
            Route::get('/', 'index')->name('article-management');
            Route::get('/create', 'create')->name('article-management.create');
            Route::post('/', 'store')->name('article-management.store');
            Route::get('edit/{id}', 'edit')->name('article-management.edit');
            Route::get('show/{id}', 'show')->name('article-management.show');
            Route::put('update/{id}', 'update')->name('article-management.update');
            Route::delete('delete/{id}', 'destroy')->name('article-management.destroy');
        });

    Route::controller(MediaController::class)
        ->prefix('media-management')
        ->group(function () {
            Route::get('/', 'index')->name('media-management');
            Route::get('/create', 'create')->name('media-management.create');
            Route::post('/', 'store')->name('media-management.store');
            Route::get('edit/{id}', 'edit')->name('media-management.edit');
            Route::get('show/{id}', 'show')->name('media-management.show');
            Route::put('update/{id}', 'update')->name('media-management.update');
            Route::delete('delete/{id}', 'destroy')->name('media-management.destroy');
        });

    Route::middleware('auth')->group(function () {
        Route::resource('media', MediaController::class);
    });

    // editorial scheduling
    Route::controller(EditorialSchedulingController::class)
        ->prefix('editorial-scheduling')
        ->group(function () {
            Route::get('/', 'index')->name('editorial-scheduling');
        });

	Route::controller(ArchiveController::class)
	->prefix('archive')
	->group(function () {
		Route::get('/','index')->name('archive');
		Route::get('view/{type}/{id}','view')->name('archive.view');
	});

    Route::controller(UserController::class)
        ->prefix('user-management')
        ->group(function () {
            Route::get('/', 'index')->name('user-management');
            Route::get('/create', 'create')->name('user-management.create');
            Route::post('/', 'store')->name('user-management.store');
            Route::get('/{id}/edit', 'edit')->name('user-management.edit');
            Route::get('/{id}', 'show')->name('user-management.show');
            Route::put('/{id}', 'update')->name('user-management.update');
            Route::delete('/{id}', 'destroy')->name('user-management.destroy');
            Route::get('/reset-password/{id}', 'resetPassword')->name('user-management.reset-password');
            Route::post('/reset-password/{id}', 'updatePassword')->name('user-management.update-password');
        });

    Route::controller(ProfileController::class)
        ->prefix('settings')
        ->group(function () {
            Route::get('/', 'index')->name('profile.index');
            Route::put('/update', 'update')->name('profile.update');
        });
});
