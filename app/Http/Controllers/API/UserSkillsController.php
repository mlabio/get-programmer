<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UserSkill;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSkillsController extends Controller
{

    public function __construct()
    {
        $this->middleware('api');
    }

    public function index () {
        $user = Auth::user();

        return response()->json($user, 200);
    }
    
    public function store(Request $request) {
        for($a = 0; $a < count($request->skills); $a++) {
            $data = array(
                'skill_id' => $request->skills[$a]['id'],
                'skill_name' => $request->skills[$a]['skill_name'],
                'user_id' => $request->user_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            $insertData[] = $data;
        }

        if(count($insertData) > 0) {
            UserSkill::insert($insertData);
            
            return ['message' => 'Skills Inserted successfully'];
        }
        else {
            return ['message' => 'Failed to add user skills'];
        }
    }

    public function show($user_id) {   
        $skills = DB::table('skills')
                            ->select('id', 'skill_name')
                            ->get(); 

        $user_skill = DB::table('userskills')
                    ->select('skill_id', 'skill_name', 'user_id')
                    ->where('user_id', '=', $user_id)
                    ->get();

        $data = array(
            'skills' => $skills,
            'user_skill' => $user_skill
        );

        return $data;
    }

}
