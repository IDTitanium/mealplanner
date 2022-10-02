<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanSchedule;
use App\Models\User;
use App\Models\Weekday;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan1 = Plan::firstOrCreate([
            'name' => 'Plan for week 1',
            'is_default' => true,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id
        ]);

        $plan2 = Plan::firstOrCreate([
            'name' => 'Plan for week 2',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id
        ]);

        foreach([$plan1, $plan2] as $plan) {
            PlanSchedule::updateOrCreate(
                [
                    'weekday_id' => 1,
                    'meal_type_id' => rand(1,3),
                ],
                [
                'plan_id' => $plan->id,
                'meal_name' => 'Egusi',
                'created_by' => User::first()->id,
                'updated_by' => User::first()->id
            ]);
        }
    }
}
