<?php

namespace App\Http\Controllers;

use App\Models\MealType;
use App\Models\Plan;
use App\Models\PlanSchedule;
use App\Models\Weekday;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class PlanController extends Controller
{
    public function getDefaultPlanSchedules() {
        $data = Plan::getPlanSchedulesByWeekDay();
        return response()->json(
            [
                'message' => __('Data fetched successfully'),
                'data' => $data,
            ],
            Response::HTTP_OK);
    }

    public function getMealForToday() {
        $data = Plan::mealForToday();
        return response()->json([
            'message' => __('Data fetched successfully'),
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function createNewPlan() {
        return Inertia::render('CreatePlan');
    }

    public function storeNewPlan(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3',
            'is_default' => 'required|boolean'
        ]);

        $planName = $request->name;
        $isDefault = $request->is_default;

        if($isDefault) {
            Plan::setAllDefaultFalse();
        }

        $user = auth()->user();

        Plan::create([
            'name' => $planName,
            'is_default' => $isDefault,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            'family_id' => $user->family_id
        ]);

        return redirect(RouteServiceProvider::HOME);
    }

    public function createPlanSchedule() {
        return Inertia::render('CreatePlanSchedule', [
            'meal_types' => MealType::all(['id', 'name']),
            'weekdays' => Weekday::all(['id', 'name']),
            'plans' => Plan::where('family_id', auth()->user()->family_id)->get()
        ]);
    }

    public function storeSchedule(Request $request) {
        $request->validate([
            'meal_name' => 'required|string|min:3',
            'weekday' => 'required|exists:weekdays,id',
            'meal_type' => 'required|exists:meal_types,id',
            'plan' => 'required|exists:plans,id'
        ]);

        PlanSchedule::updateOrCreate(
            [
                'weekday_id' => $request->weekday,
                'meal_type_id' => $request->meal_type,
                'plan_id' => $request->plan,
            ],
            [
                'meal_name' => $request->meal_name,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]
        );

        return redirect(RouteServiceProvider::HOME);
    }

    public function getMealForTomorrow() {
        $data = Plan::mealForTomorrow();
        return response()->json([
            'message' => __('Data fetched successfully'),
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function getActivePlan() {
        $data = Plan::where('is_default', true)->first();
        return response()->json([
            'message' => __('Data fetched successfully'),
            'data' => $data
        ], Response::HTTP_OK);
    }
}
