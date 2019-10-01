<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\profileDeletionAdmin;
use App\Notifications\profileDeletionUser;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    
    public function deleteProfile()
    {
        $user = User::findOrFail(Auth::user()->id);

        // get all admins and send them an email
        $admins = User::where('type', User::ADMIN_TYPE)->get();
        foreach($admins as $admin){
            Notification::route('mail', $admin->email)->notify(new profileDeletionAdmin($user));
        }

        // also send a confirmation email to the user
        Notification::route('mail', $user->email)->notify(new profileDeletionUser());

        Log::channel('admin')->info('A user has deleted their profile', [
            'username' => $user->name, 
            'email' => $user->email, 
            'school' => $user->school_name,
        ]);

        Auth::logout();

        $user->delete();


        return redirect(route('home'));
    }
}
