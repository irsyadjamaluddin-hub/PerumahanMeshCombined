<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::count()) {

            DB::table('users')->insert([
                [
                    'full_name' => 'Admin',
                    'username' => 'Admin',
                    'email' => 'admin@ims.moe.gov.bn',
                    'password' => Hash::make('aaaaaa'),
                    'disabled' => 0,
                    'status' => "in",
                ],
                [
                    'full_name' => 'Network Asset Supervisor',
                    'username' => 'NAS',
                    'email' => 'nas@ims.moe.gov.bn',
                    'password' => Hash::make('aaaaaa'),
                    'disabled' => 0,
                    'status' => "in",
                ],
                [
                    'full_name' => 'Supervisor',
                    'username' => 'SV',
                    'email' => 'supervisor@ims.moe.gov.bn',
                    'password' => Hash::make('aaaaaa'),
                    'disabled' => 0,
                    'status' => "in",
                ],
                [
                    'full_name' => 'Storekeeper',
                    'username' => 'SK',
                    'email' => 'storekeeper@ims.moe.gov.bn',
                    'password' => Hash::make('aaaaaa'),
                    'disabled' => 0,
                    'status' => "in",
                ],
                [
                    'full_name' => 'Technical Team',
                    'username' => 'TT',
                    'email' => 'techteam@ims.moe.gov.bn',
                    'password' => Hash::make('aaaaaa'),
                    'disabled' => 0,
                    'status' => "in",
                ],
            ]);

        }
    }
}
