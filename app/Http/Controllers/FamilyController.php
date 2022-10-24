<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\MealType;
use App\Models\Plan;
use App\Models\PlanSchedule;
use App\Models\User;
use App\Models\Weekday;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class FamilyController extends Controller
{
    public function addFamilyMember() {
        if (User::where('family_id', auth()->user()->family_id)->count() >= 10) {
            return Inertia::render('Dashboard')->with('errors', 'Max Members Reached');
        }
        return Inertia::render('Setting/AddAFamilyMember');
    }

    public function storeNewFamilyMember(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email'
        ]);

        $admin = auth()->user();

        $data = $request->only(['name', 'email']);
        $data['family_id'] = $admin->family_id;

        User::createNewUser($data);

        return $this->listFamilyMembers();
    }

    public function listFamilyMembers() {
        $data = User::where('family_id', auth()->user()->family_id)->get();
        return Inertia::render('Setting/FamilyMembers', ['users' => $data]);
    }

    public function getJoinFamilyStep1() {
        return Inertia::render('Setting/JoinFamilyStep1');
    }

    public function checkStep1(Request $request) {
        $request->validate([
            'family_name' => ['required','string', 'exists:families,name', 'bail'],
            'email' => ['required', 'email', function ($_attribute, $value, $fail) use($request) {
                $family = Family::where('name', $request->family_name)->first();
                if(!$family) return;
                $userHasBeenAdded = User::where('family_id', $family->id)->where('email', $value)->first();

                if(!$userHasBeenAdded) {
                    $fail('This user has not been invited to this family');
                }
            }]
        ]);

        return redirect('/join-2')->with(['details' => $request->only(['family_name', 'email'])]);
    }

    public function getJoinFamilyStep2() {
        return Inertia::render('Setting/JoinFamilyStep2');
    }

    public function checkStep2(Request $request) {
        $request->validate([
            'family_name' => ['required','string', 'exists:families,name', 'bail'],
            'email' => ['required', 'email', function ($_attribute, $value, $fail) use($request) {
                $family = Family::where('name', $request->family_name)->first();
                if(!$family) return;
                $userHasBeenAdded = User::where('family_id', $family->id)->where('email', $value)->first();

                if(!$userHasBeenAdded) {
                    $fail('This user has not been invited to this family');
                }
            }],
            'password' => 'required'
        ]);

        User::where('email', $request->email)->update([
            'password' => $request->password
        ]);

        return redirect('/welcome');
    }
}
