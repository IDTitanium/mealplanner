<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealType extends Model
{
    use HasFactory;

    const BREAKFAST = 'Breakfast';
    const LUNCH = 'Lunch';
    const DINNER = 'Dinner';
}
