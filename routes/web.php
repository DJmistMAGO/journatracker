<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\MdiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\PubManagementController;
use App\Http\Controllers\tables\Basic as TablesBasic;

// spj routes here!!!!
use App\Http\Controllers\PublicationMgmtController;
use App\Http\Controllers\ArticleManagementController;
use App\Http\Controllers\EditorialSchedulingController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\users\User;

// welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

    Route::controller(PubManagementController::class)
        ->prefix('publication')
        ->group(function () {
            Route::get('/', 'index')->name('publication-management');
            Route::get('/create', 'create')->name('publication.create');
        });

    Route::controller(ArticleManagementController::class)
        ->prefix('article-management')
        ->group(function () {
            Route::get('/', 'index')->name('article-management');
            Route::get('/create', 'create')->name('article-management.create');
            Route::post('/', 'store')->name('article-management.store');
            Route::get('/{id}/edit', 'edit')->name('article-management.edit');
            Route::get('/{id}', 'show')->name('article-management.show');
            Route::put('/{id}', 'update')->name('article-management.update');
            Route::delete('/{id}', 'destroy')->name('article-management.destroy');
        });

    // editorial scheduling
    Route::controller(EditorialSchedulingController::class)
        ->prefix('editorial-scheduling')
        ->group(function () {
            Route::get('/', 'index')->name('editorial-scheduling');
            //   Route::get('/create', 'create')->name('editorial-scheduling.create');
            //   Route::post('/', 'store')->name('editorial-scheduling.store');
            //   Route::get('/{id}/edit', 'edit')->name('editorial-scheduling.edit');
            //   Route::get('/{id}', 'show')->name('editorial-scheduling.show');
            //   Route::put('/{id}', 'update')->name('editorial-scheduling.update');
            //   Route::delete('/{id}', 'destroy')->name('editorial-scheduling.destroy');
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

    Route::get('/incident-report', [IncidentReportController::class, 'index'])->name('incident-report');

    // Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
    // Route::get('/user-management/create', [UserController::class, 'create'])->name('user-management.create');
});

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// // pages
// Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
//   'pages-account-settings-account'
// );
// Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
//   'pages-account-settings-notifications'
// );
// Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
//   'pages-account-settings-connections'
// );
// Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
// Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
//   'pages-misc-under-maintenance'
// );

// // cards
// Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// // User Interface
// Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
// Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
// Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
// Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
// Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
// Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
// Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
// Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
// Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
// Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
// Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
// Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
// Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
// Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
// Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
// Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
// Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
// Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
// Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// // extended ui
// Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
// Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// // icons
// Route::get('/icons/icons-mdi', [MdiIcons::class, 'index'])->name('icons-mdi');

// // form elements
// Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
// Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// // form layouts
// Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
// Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// // tables
// Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

//spj routes hereee!!!

//Publication Management Controller
