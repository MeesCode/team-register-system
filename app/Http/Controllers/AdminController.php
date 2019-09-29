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

    public function addTeam($id){
        $user = User::findOrFail($id);
        return view('admin.addTeamAdmin', ['user' => $user]);
    }

    public function deleteUser(Request $request){
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect(route('admin'));
    }

    public function createTeam(Request $request){

        // get the id's of all registered users
        $ids = User::all()->pluck('id')->toArray();

        // make sure the request is valid
        $categories = ['rescue_basic', 'rescue_advanced', 'soccer', 'dancing'];
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', Rule::in($ids)],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in($categories)],
            'members_amount' => ['required', 'integer', 'max:4', 'min:1'],
            'age_oldest_member' => ['required', 'integer', 'min:0'],
        ]);

        if ($validator->fails()) {
            return redirect(route('addTeamAdmin', [$request->user_id]))->withErrors($validator)->withInput();
        }

        $team = new Team();
        $team->user_id = $request->user_id;
        $team->name = $request->name;
        $team->category = $request->category;
        $team->members_amount = $request->members_amount;
        $team->age_oldest_member = $request->age_oldest_member;
        
        $team->save();

        // disable email notifications on admin actions

        // get all admins and send them an email
        // $admins = User::where('type', User::ADMIN_TYPE)->get();
        // foreach($admins as $admin){
        //     Notification::route('mail', $admin->email)->notify(new newTeamAdmin($team));
        // }

        // // also send a confirmation email to the user
        // $user = User::find($team->user_id);
        // Notification::route('mail', $user->email)->notify(new newTeamUser($team));
        
        return redirect(route('userDetail', [$request->user_id]));

    }


}
