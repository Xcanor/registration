<?php

use Illuminate\Database\Seeder;
use App\Agency;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agency::create([
            'name' => 'Mohamed',
            'email' => 'Mohamed@example.com',
            'phone' => '01003220088',
            'address' => 'ain shames',
            'photo' => 'default.jpg',
            'country' => 'cairo',
            'password' => Hash::make('123456789'),
        ]);
    }
}
