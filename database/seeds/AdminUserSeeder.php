<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Ahmed',
            'email' => 'Ahmed@example.com',
            'password' => Hash::make('123456789'),
            'super_admin' => true
        ]);
    }
}
