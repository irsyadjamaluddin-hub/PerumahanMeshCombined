<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
		'name'			=>	'moeadmin',
		'email'			=>	'moeadmin@moe.gov.bn',
		'ic_no'			=>	'01084002',
		'email_verified_at'		=>	now(),
		'password'		=>	Hash::make('password'),
		'remember_token'	=> Str::random(100),
		'created_at' => now(),
		'updated_at' => now(),
		
		]);
    }
}
