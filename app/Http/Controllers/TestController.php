<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function test(Request $request) {
        $body = $request->body();
        Log::info("Request from test controller", [$body]);
    }
}
