<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skills;

class SkillsController extends Controller
{
    public function index() {
        return Skills::latest()->paginate(10);
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
