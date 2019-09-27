<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::where('user_id', Auth::user()->id)->get();
        return view('teams', ['teams' => $teams]);
    }

    public function addIndex()
    {
        return view('addteam');
    }

    public function createTeam(Request $request){
        // make sure the request is valid
        $categories = ['rescue_basic', 'rescue_advanced', 'soccer', 'dancing'];
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in($categories)],
            'members_amount' => ['required', 'integer', 'max:4', 'min:1'],
            'age_oldest_member' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect(route('addTeam'))->withErrors($validator)->withInput();
        }

        $team = new Team();
        $team->user_id = Auth::user()->id;
        $team->name = $request->name;
        $team->category = $request->category;
        $team->members_amount = $request->members_amount;
        $team->age_oldest_member = $request->age_oldest_member;
        
        $team->save();

        return redirect(route('teams'));

    }

    public function removeTeam(Request $request){
        // get team by it's id
        $team = Team::findOrFail($request->id);

        // if the team is not owned by the current user, reject
        if(Auth::user()->id != $team->user_id){
            return;
        }

        $team->delete();

        return redirect(route('teams'));

    }
}
