<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Auth Routes
Route::post('/auth/login/admin', [AuthController::class, 'loginAdmin']);
Route::post('/auth/login/user', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Admin Routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index']);
        
        Route::apiResource('users', Admin\UserController::class);
        Route::patch('users/{user}/toggle-status', [Admin\UserController::class, 'toggleStatus']);
        
        Route::apiResource('leads', Admin\LeadController::class);
        Route::apiResource('simulations', Admin\SimulationController::class);
        Route::apiResource('quotations', Admin\QuotationController::class);
        Route::apiResource('pricing-rules', Admin\PricingRuleController::class);
        Route::apiResource('energy-solutions', Admin\EnergySolutionController::class);
        Route::apiResource('agricultural-models', Admin\AgriculturalModelController::class);
        
        Route::get('/analytics', [Admin\AnalyticsController::class, 'index']);
    });

    // Site Routes (Authenticated)
    Route::prefix('site')->group(function () {
        Route::post('/simulations', [Api\PublicSimulationController::class, 'store']);
        Route::apiResource('/appointments', Api\AppointmentController::class)->only(['index', 'store']);
        Route::post('/quotation-requests', [Api\QuotationRequestController::class, 'store']);
    });
});

// Site Routes (Public)
Route::prefix('site')->group(function () {
    Route::post('/simulations/calculate', [Api\PublicSimulationController::class, 'calculate']);
    Route::post('/leads', [Api\LeadController::class, 'store']);
    
    // Nouveau Calculateur Énergie AIAE
    Route::prefix('energy')->group(function () {
        Route::get('/equipements', [Api\EnergieApiController::class, 'getEquipements']);
        Route::get('/zones', [Api\EnergieApiController::class, 'getZones']);
        Route::post('/calculate', [Api\EnergieApiController::class, 'calculer'])->middleware('throttle:30,1');
        Route::post('/calculate-biogaz', [Api\EnergieApiController::class, 'calculerBiogaz'])->middleware('throttle:30,1');
        Route::post('/save', [Api\EnergieApiController::class, 'saveEstimation']);
    });
});
