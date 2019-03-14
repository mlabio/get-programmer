<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return User::latest()->paginate(10);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);

        return User::Create([
            'name' => $request['name'],
            'email' => $request['email'],
            'bio' => $request['bio'],
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
            'remember_token' => str_random(10)
        ]);
    }

    public function show($id) {
        
    }   

    public function update(Request $request, $id) {

    }

    public function destroy($id) {
        $user = User::FindOrFail($id);
        $user->delete();
    }
}
