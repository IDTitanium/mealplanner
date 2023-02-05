<?php

use App\Models\Family;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedFamilyForExistingData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $creator = User::where('email', 'idriseun222@gmail.com')->first();

        if ($creator) {
            $family = Family::firstOrCreate(
                [
                    'name' => "The Idris Family"
                ],
                [
                    'creator_id' => $creator->id
                ]
            );

            User::query()->update([
                'family_id' => $family->id
            ]);

            Plan::query()->update([
                'family_id' => $family->id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
