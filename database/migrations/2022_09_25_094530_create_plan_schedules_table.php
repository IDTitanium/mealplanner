<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekday_id')->constrained('weekdays');
            $table->foreignId('meal_type_id')->constrained('meal_types');
            $table->foreignId('plan_id')->constrained('plans');
            $table->string('meal_name');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_schedules');
    }
}
