<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\SectorTypeController;
use App\Http\Controllers\Admin\SimulationController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\SolController;
use App\Http\Controllers\Admin\TypeBatimentController;
use App\Http\Controllers\Admin\TemplateProjetController;
use App\Http\Controllers\Admin\EquipementOptionController;
use App\Http\Controllers\Auth\FrontendAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SimulatorController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/divisions', [FrontendController::class, 'divisions'])->name('divisions');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/diaspora', [FrontendController::class, 'diaspora'])->name('diaspora');
Route::get('/mentions-legales', [FrontendController::class, 'mentionsLegales'])->name('mentions-legales');

// Frontend Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [FrontendAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [FrontendAuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [FrontendAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [FrontendAuthController::class, 'register'])->name('register.submit');
});
Route::get('/mon-espace', [SimulatorController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/mon-espace/profile/update', [SimulatorController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::get('/mon-espace/simulations/{id}', [SimulatorController::class, 'show'])->name('profile.simulations.show')->middleware('auth');
Route::post('/simulator/save', [SimulatorController::class, 'save'])->name('simulator.save');
Route::post('/logout', [FrontendAuthController::class, 'logout'])->name('logout');

// Simulator Routes
Route::get('/simulator', [SimulatorController::class, 'index'])->name('simulator.index');
Route::get('/simulator/v1', [SimulatorController::class, 'simulatorV1'])->name('simulator.v1');
Route::get('/simulator/results', [SimulatorController::class, 'results'])->name('simulator.results');

// Energy Calculator Routes
Route::get('/energie/calculateur', [\App\Http\Controllers\EnergieController::class, 'calculator'])->name('energie.calculator');
Route::get('/energie/resultats/{code}', [\App\Http\Controllers\EnergieController::class, 'show'])->name('energie.results');

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Potential other admin routes
        Route::resource('leads', LeadController::class);
        Route::resource('appointments', AppointmentController::class);
        Route::resource('simulations', SimulationController::class)->only(['index', 'show', 'destroy']);
        Route::resource('quotations', QuotationController::class)->only(['index', 'show', 'destroy']);
        Route::post('quotations/{quotation}/accept', [QuotationController::class, 'accept'])->name('quotations.accept');
        Route::post('quotations/{quotation}/reject', [QuotationController::class, 'reject'])->name('quotations.reject');
        Route::post('quotations/{quotation}/send', [QuotationController::class, 'send'])->name('quotations.send');
        
        // Settings & Configuration
        Route::resource('divisions', DivisionController::class);
        Route::resource('sectors', SectorController::class);
        Route::resource('sector-types', SectorTypeController::class);
        Route::post('sector-types/{sector_type}/pricing-rules', [SectorTypeController::class, 'storePricingRule'])->name('sector-types.pricing-rules.store');
        Route::post('sector-types/{sector_type}/pricing-coefficients', [SectorTypeController::class, 'storePricingCoefficient'])->name('sector-types.pricing-coefficients.store');

        // Immobilier Pro Reference Data
        Route::resource('zones', ZoneController::class);
        Route::resource('sols', SolController::class);
        Route::resource('type-batiments', TypeBatimentController::class);
        Route::resource('templates-projets', TemplateProjetController::class);
        Route::resource('equipement-options', EquipementOptionController::class);

        // User Management
        Route::get('users', function() { return view('admin.users.index'); })->name('users.index');
        Route::get('users/create', function() { return view('admin.users.create'); })->name('users.create');
        Route::get('users/{user}/edit', function(\App\Models\User $user) { return view('admin.users.edit', compact('user')); })->name('users.edit');
        
        // API Routes for Users
        Route::group(['prefix' => 'users-api', 'as' => 'users.api.'], function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('{user}', [UserController::class, 'show'])->name('show');
            Route::put('{user}', [UserController::class, 'update'])->name('update');
            Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        });

        Route::get('/help', [HelpController::class, 'index'])->name('help');
    });
});
