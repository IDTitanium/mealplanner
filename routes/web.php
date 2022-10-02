<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
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

Route::get('/', [AuthController::class, 'getHome']);

Route::middleware(['auth', 'verified'])->group(function($route) {
    $route->get('/dashboard', [AuthController::class, 'getDashboard'])->name('dashboard');
    $route->get('/createplan', [PlanController::class, 'createNewPlan'])->name('create-plan');
    $route->get('/createschedule', [PlanController::class, 'createPlanSchedule'])->name('create-schedule');
});

require __DIR__.'/auth.php';
