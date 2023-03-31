<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;

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
if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', [AuthController::class, 'getHome'])->name('welcome');
Route::get('/join-1', [FamilyController::class, 'getJoinFamilyStep1'])->name('join-step-1');
Route::get('/join-2', [FamilyController::class, 'getJoinFamilyStep2'])->name('join-step-2');
Route::post('/check-step-1', [FamilyController::class, 'checkStep1'])->name('check-join-step-1');
Route::post('/check-step-2', [FamilyController::class, 'checkStep2'])->name('check-join-step-2');

Route::middleware(['auth', 'verified'])->group(function($route) {
    $route->get('/dashboard', [AuthController::class, 'getDashboard'])->name('dashboard');
    $route->get('/createplan', [PlanController::class, 'createNewPlan'])->name('create-plan');
    $route->get('/createschedule', [PlanController::class, 'createPlanSchedule'])->name('create-schedule');
    $route->get('/add-member', [FamilyController::class, 'addFamilyMember'])->name('add-member');
    $route->post('/store-member', [FamilyController::class, 'storeNewFamilyMember'])->name('store-member');
    $route->get('/list-members', [FamilyController::class, 'listFamilyMembers'])->name('list-members');
    $route->delete('/remove-member/{id}', [FamilyController::class, 'removeFamilyMember'])->name('remove-family-member');
});

/** API Routes work around */

Route::post('/login', [AuthController::class, 'apiLogin'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function($route){
    $route->get('/plans', [PlanController::class, 'getDefaultPlanSchedules'])->name('api.plans');
    $route->get('/plans/today', [PlanController::class, 'getMealForToday'])->name('api.plans.today');
    $route->get('/plans/tomorrow', [PlanController::class, 'getMealForTomorrow'])->name('api.plans.tomorrow');
    $route->post('/plans', [PlanController::class, 'storeNewPlan'])->name('api.plans.store');
    $route->post('/schedule', [PlanController::class, 'storeSchedule'])->name('api.schedule.store');
    $route->get('/plans/active', [PlanController::class, 'getActivePlan'])->name('api.plans.active');
});

Route::post('/test', [TestController::class, 'test']);

require __DIR__.'/auth.php';
