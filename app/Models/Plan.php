<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    //TODO: define relations;

    public static function getPlanSchedulesByWeekDay()
    {
        $plan = static::where('is_default', true)->where('created_by', auth()->id())->first();
        if (!$plan) return [];
        $planSchedules =
        PlanSchedule::where('plan_id', $plan->id)->where('created_by', auth()->id())
        ->orderBy('weekday_id', 'asc')->get();
        return $planSchedules;
    }

    public static function mealForToday()
    {
        $day = now()->format('l');
        $breakfast = static::mealQuery($day)->where('meal_types.name', MealType::BREAKFAST)->first();

        $lunch = static::mealQuery($day)->where('meal_types.name',
        MealType::LUNCH)->first();

        $dinner = static::mealQuery($day)->where('meal_types.name', MealType::DINNER)->first();

        return [
            'breakfast' => $breakfast,
            'lunch' => $lunch,
            'dinner' => $dinner
        ];
    }

    public static function mealQuery($day)
    {
        return PlanSchedule::join('plans', 'plans.id', 'plan_schedules.plan_id')
        ->join('weekdays', 'weekdays.id', 'plan_schedules.weekday_id')
        ->join('meal_types', 'meal_types.id', 'plan_schedules.meal_type_id')
        ->where('plans.is_default', true)
        ->where('weekdays.name', $day)
        ->where('plan_schedules.created_by', auth()->id());
    }

    public static function setAllDefaultFalse()
    {
        static::where('is_default', true)->where('created_by', auth()->id())->update(['is_default' => false]);
    }

    public static function mealForTomorrow()
    {
        $day = now()->tomorrow()->format('l');
        $breakfast = static::mealQuery($day)->where('meal_types.name', MealType::BREAKFAST)->first();

        $lunch = static::mealQuery($day)->where('meal_types.name',
        MealType::LUNCH)->first();

        $dinner = static::mealQuery($day)->where('meal_types.name', MealType::DINNER)->first();

        return [
            'breakfast' => $breakfast,
            'lunch' => $lunch,
            'dinner' => $dinner
        ];
    }
}
