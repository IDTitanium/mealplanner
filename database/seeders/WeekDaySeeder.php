<?php

namespace Database\Seeders;

use App\Models\Weekday;
use Illuminate\Database\Seeder;

class WeekDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->weekDays() as $weekDay) {
            Weekday::firstOrCreate([
                'name' => $weekDay
            ]);
        }
    }

    private function weekDays()
    {
        return [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];
    }
}
