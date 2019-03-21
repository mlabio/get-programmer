<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skills;
use Illuminate\Support\Facades\DB;

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

    public function show($id) {
        //return auth('api')->user();
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
