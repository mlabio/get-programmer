<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index () {

    }

    public function show () {
        return Auth::user();


        return response()->Auth::user();
    }
}
