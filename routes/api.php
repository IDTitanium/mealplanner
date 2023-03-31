<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if (App::environment('production')) {
    URL::forceScheme('https');
}

// Route::post('/login', [AuthController::class, 'apiLogin'])->name('api.login');

// Route::middleware(['auth:sanctum'])->group(function($route){
//     $route->get('/plans', [PlanController::class, 'getDefaultPlanSchedules'])->name('api.plans');
//     $route->get('/plans/today', [PlanController::class, 'getMealForToday'])->name('api.plans.today');
//     $route->get('/plans/tomorrow', [PlanController::class, 'getMealForTomorrow'])->name('api.plans.tomorrow');
//     $route->post('/plans', [PlanController::class, 'storeNewPlan'])->name('api.plans.store');
//     $route->post('/schedule', [PlanController::class, 'storeSchedule'])->name('api.schedule.store');
//     $route->get('/plans/active', [PlanController::class, 'getActivePlan'])->name('api.plans.active');
// });

Route::post('/test', [TestController::class, 'test']);
