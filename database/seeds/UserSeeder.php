<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Mohamed',
            'last_name' => 'Hassan',
            'email' => 'mohamed@example.com',
            'telephone' => '01065440124',
            'gender' => 'male',
            'date_of_birth' => '1997-3-12',
            'status' => true,
            'avatar' => 'default.jpg',
            'password' => Hash::make('123456789'),
        ]);
    }
}
