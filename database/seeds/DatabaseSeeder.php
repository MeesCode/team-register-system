<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // admin
        User::create([
            'name' => env('MAIL_FROM_NAME'),
            'email' => env('MAIL_FROM_ADDRESS'),
            'phone_number' => 'nvt',
            'school_name' => 'nvt',
            'school_place' => 'nvt',
            'school_address' => 'nvt',
            'school_postal_code' => 'nvt',
            'password' => Hash::make('secret'),
            'type' => User::ADMIN_TYPE, 
        ]);

        // regualr test user
        User::create([
            'name' => 'Mees Brinkhuis',
            'email' => 'mees@space.nl',
            'phone_number' => '1234567890',
            'school_name' => 'TU Delft',
            'school_place' => 'Delft',
            'school_address' => 'Delft 101',
            'school_postal_code' => '1234AB',
            'password' => Hash::make('secret'),
            'type' => User::DEFAULT_TYPE, 
        ]);
        
    }
}
