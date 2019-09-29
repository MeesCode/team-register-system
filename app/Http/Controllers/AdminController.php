<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $users = User::all();

        // include school names as a team property
        foreach($teams as $team){
            $team->school_name = User::find($team->user_id)->school_name;
        }
        
        return view('admin.admin', ['teams' => $teams, 'users' => $users]);
    }

    public function userDetail($id)
    {
        $user = User::findOrFail($id);
        $teams = Team::where('user_id', $id)->get();
        
        return view('admin.userDetail', ['teams' => $teams, 'user' => $user]);
    }

    public function removeTeam(Request $request){
        // get team by it's id
        $team = Team::findOrFail($request->id);

        $team->delete();

        return redirect(route('admin'));

    }

    public function overview(Request $request){
        return view('admin.overview');


    }

}
