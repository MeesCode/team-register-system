<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\userRegistrationAdmin;
use App\Notifications\userRegistrationUser;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/overview';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^.+\s.+$/i'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:10', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'school_name' => ['required', 'string', 'max:255'],
            'school_place' => ['required', 'string', 'max:255'],
            'school_address' => ['required', 'string', 'max:255', 'regex:/^.+\d+.*$/i'],
            'school_postal_code' => ['required', 'string', 'max:255', 'regex:/^\d{4}\s*[A-Za-z]{2}$/i'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // send the user a confirmation email
        $user = (object)[];
        $user->name = $data['name'];
        $user->school_name = $data['school_name'];
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'];
        $user->school_place = $data['school_place'];
        $user->school_address = $data['school_address'];
        $user->school_postal_code = $data['school_postal_code'];

        Notification::route('mail', $user->email)->notify(new userRegistrationUser());

        // get all admins and send them an email
        $admins = User::where('type', User::ADMIN_TYPE)->get();
        foreach($admins as $admin){
            Notification::route('mail', $admin->email)->notify(new userRegistrationAdmin($user));
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'school_name' => $data['school_name'],
            'school_place' => $data['school_place'],
            'school_address' => $data['school_address'],
            'school_postal_code' => $data['school_postal_code'],
            'password' => Hash::make($data['password']),
            'type' => User::DEFAULT_TYPE, 
        ]);
    }
}
