<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function apiLogin(Request $request) {
        $validator = Validator::make(
        $request->only('email', 'password'),
        [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => __('Validation failed')
            ]);
        }

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return auth()->user()->createToken('user-token');
        } else {
            return response()->json([
                'message' => 'Incorrect credentials'
            ]);
        }
    }

    public function getHome() {
       if (auth()->user()) {
            return redirect('/dashboard');
       }
       return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function getDashboard() {
        return Inertia::render('Dashboard');
    }
}
