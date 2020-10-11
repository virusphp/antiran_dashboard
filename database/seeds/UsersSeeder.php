<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'sugandi',
            'username' => 'virusphp',
            'email' => 'virusphp@gmail.com',
            'password' => Hash::make('password.'),
            'created_at' => Carbon::Now()
        ]);
    }
}
