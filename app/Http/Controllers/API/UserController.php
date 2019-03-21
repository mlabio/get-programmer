<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    public function index() {
        return User::latest()->paginate(5);
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
        //return auth('api')->user();
    }   

    public function update(Request $request, $id) {

        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6'
        ]);

        $user->update($request->all());
        return ['message' => 'Updated user info'];
    }

    public function destroy($id) {
        $user = User::findOrFails($id);
        $user->delete();
    }
}
