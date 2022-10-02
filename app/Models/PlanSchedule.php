<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanSchedule extends Model
{
    use HasFactory;

    protected $with = ['weekday', 'mealType'];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function weekday() {
        return $this->belongsTo(Weekday::class);
    }

    public function mealType() {
        return $this->belongsTo(MealType::class);
    }
}
