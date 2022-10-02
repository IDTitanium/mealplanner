<?php

namespace Database\Seeders;

use App\Models\MealType;
use Illuminate\Database\Seeder;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->mealTypes() as $mealType) {
            MealType::firstOrCreate([
                'name' => $mealType
            ]);
        }
    }

    private function mealTypes() {
        return [
            'Breakfast',
            'Lunch',
            'Dinner'
        ];
    }

}
