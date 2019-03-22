<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function show(Request $request,$next) {
        $user = Auth::user();

        if($user) {
            return $next($request);
        }
    }
}
