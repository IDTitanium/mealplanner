<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Plan extends Model
{
    use HasFactory;

    protected static function boot() {
        parent::boot();

        $user = auth()->user();
        if($user) {
            static::addGlobalScope('family_id', function (Builder $builder) use ($user) {
                $builder->where('family_id', $user->family_id);
            });
        }
    }

    public static function getPlanSchedulesByWeekDay()
    {
        $plan = static::where('is_default', true)->first();
        if (!$plan) return [];
        $planSchedules =
        PlanSchedule::where('plan_id', $plan->id)->orderBy('weekday_id', 'asc')->get();
        return $planSchedules;
    }

    public static function getPlanSchedulesByMealType()
    {
        $results = DB::table('plan_schedules')
                ->join('plans', function ($join) {
                    $join->on('plan_schedules.plan_id', '=', 'plans.id')
                    ->where('plans.is_default', '=', true);
                })
                ->join('meal_types', 'plan_schedules.meal_type_id', '=', 'meal_types.id')
                ->select('meal_types.name as meal_type_name', 'plan_schedules.*')
                ->groupBy('plan_schedules.id')
                ->get();

        return $results;
    }

    public static function getMealForDayByType(string $type, string $day)
    {
        return DB::table('plan_schedules')
        ->join('plans', function ($join) {
            $join->on('plan_schedules.plan_id', '=', 'plans.id')
            ->where('plans.is_default', '=', true);
        })
        ->join('meal_types', 'plan_schedules.meal_type_id', '=', 'meal_types.id')
        ->join('weekdays', 'plan_schedules.weekday_id', '=', 'weekdays.id')
        ->where('meal_types.name', ucfirst($type))
        ->where('weekdays.name', ucfirst($day))
        ->select('plan_schedules.meal_name')
        ->first();
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
        ->where('plans.family_id', auth()->user()->family_id);
    }

    public static function setAllDefaultFalse()
    {
        static::where('is_default', true)->update(['is_default' => false]);
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
