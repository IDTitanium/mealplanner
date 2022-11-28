<?php

namespace App\Http\Controllers;

use App\Mail\SendUserInvitedEmail;
use App\Models\Family;
use App\Models\MealType;
use App\Models\Plan;
use App\Models\PlanSchedule;
use App\Models\User;
use App\Models\Weekday;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use App\Traits\Toast;
use Illuminate\Support\Facades\Mail;

class FamilyController extends Controller
{
    public function addFamilyMember() {
        if (User::where('family_id', auth()->user()->family_id)->count() >= 10) {
            Toast::show("Max Members Reached", "You have reached maximum number of members", 'error');
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
        Toast::show('Success!', 'Member Added Successfully');

        $familyName = $admin->family()->first()->name;
        $baseUrl = config('app.url');
        $linkData = [
            "details" => [
                "family_name" => $familyName,
                "email" => $request->email
            ]
        ];
        $linkData = Crypt::encrypt($data);

        $link = $baseUrl . "/join-2?q=". $linkData;

        Mail::to($request->email)->send(new SendUserInvitedEmail($familyName, $link));
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
        $data = [
            "details" => [
                "family_name" => $request->family_name,
                "email" => $request->email
            ]
        ];
        $data = Crypt::encrypt($data);
        return redirect("/join-2?q=".$data);
    }

    public function getJoinFamilyStep2(Request $request) {
        $data = Crypt::decrypt($request->q);

        return Inertia::render('Setting/JoinFamilyStep2', $data);
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
            'password' => ['required', 'confirmed']
        ]);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/');
    }
}
