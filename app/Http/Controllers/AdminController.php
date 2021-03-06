<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $teams = Team::all();
        $users = User::all();

        // include school names as a team property
        foreach($teams as $team){
            $team->school_name = User::find($team->user_id)->school_name;
        }

        $teams = AdminController::filter_teams($request, $teams);
        
        $school_list = User::select('school_name')->distinct()->get();
        
        return view('admin.admin', ['teams' => $teams, 'users' => $users, 'school_list' => $school_list]);
    }

    private function filter_teams(Request $request, $teams)
    {
        $school = $request->query('school', 'any');
        $category = $request->query('category', 'any');

        if($school != 'any'){
            $teams = $teams->filter(function($team) use ($school){
                return $team->school_name == $school;
            });
        }

        if($category != 'any'){
            $teams = $teams->filter(function($team) use ($category){
                return $team->category == $category;
            });
        }
        
        return $teams;
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

    public function databaseDumpUsers(){
        Log::info('The user database table has been exported by an admin', [
            'name' => Auth::user()->name, 
            'email' => Auth::user()->email,
        ]);

        $users = User::get();
        $csvExporter = new \Laracsv\Export();
        return $csvExporter->build($users, [
            'id',
            'name', 
            'email', 
            'email_verified_at', 
            'password', 
            'remember_token', 
            'created_at', 
            'updated_at', 
            'phone_number', 
            'school_name', 
            'school_place', 
            'school_address', 
            'school_postal_code', 
            'type'
            ])->download();
    }

    public function databaseDumpTeams(){
        Log::info('The team database table has been exported by an admin', [
            'name' => Auth::user()->name, 
            'email' => Auth::user()->email,
        ]);

        $teams = Team::get();
        $csvExporter = new \Laracsv\Export();
        return $csvExporter->build($teams, [
            'id', 
            'user_id', 
            'name', 
            'category', 
            'members_amount', 
            'age_oldest_member', 
            'created_at', 
            'updated_at'
        ])->download();
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

        $user = User::findOrFail($request->user_id);

        // get the id's of all registered users
        $ids = User::all()->pluck('id')->toArray();

        // make sure the request is valid
        $categories = ['rescue_basic', 'rescue', 'soccer', 'dancing', 'groeneveld'];
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

        Log::channel('admin')->info('The team has been added by an admin', [
            'admin email' => Auth::user()->email,
            'user email' => $user->email,
            'team name' => $team->name,
        ]);

        // no email notifications on admin actions
        
        return redirect(route('userDetail', [$request->user_id]));

    }


}
