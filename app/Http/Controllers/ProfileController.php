<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\profileDeletionAdmin;
use App\Notifications\profileDeletionUser;


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

        Auth::logout();

        $user->delete();

        return redirect(route('home'));
    }
}
