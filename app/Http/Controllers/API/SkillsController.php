<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skills;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use function GuzzleHttp\json_decode;

class SkillsController extends Controller
{
    public function index() {
        $skills = DB::table('skills')
                    ->select('id', 'skill_name')
                    ->orderBy('id', 'asc')
                    ->get();

        return $skills;
    }

    public function store(Request $request) {

        $this->validate($request,[
            'skill_name' => 'required|max:191'
        ]);

        return Skills::Create([
            'skill_name' => $request['skill_name']
        ]);
        
    }

    public function show($user_id) {
        
        $userskills = DB::table('userskills')->where('user_id', '=', $user_id)->select('skill_id')->get();

        $ids = $userskills->map(function($userskill){ 
            return (int)$userskill->skill_id;
        });

        $skills = DB::table('skills')->whereNotIn('skills.id', $ids)->get();

        return $skills;

    }   

    public function update(Request $request, $id) {
        $skill = Skills::findOrFail($id);

        $this->validate($request, [
            'skill_name' => 'required|max:191'
        ]);

        $skill->update($request->all());
        return ['message' => 'Updated user info'];
    }

    public function destroy($id) {
        $skill = Skills::findOrFail($id);
        
        $skill->delete();
    }
}
