<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        if ($request->user()) {
            DB::table('sessions')->where('user_id', $request->user()->id)->delete();

            Auth::guard('web')->logout();

            return response()->json(['message' => 'Success logout']);
        }

        return response()->json(['message' => 'User unauthorized'], 401);
    }
}
