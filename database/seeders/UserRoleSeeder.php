<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!UserRole::count()) {

            DB::table('user_roles')->insert([

                // ------------------------------------------
                // Category A
                // ------------------------------------------

                [
                    'user_id' => '1',
                    'role_id' => '1',
                    'created_at' => '2024-05-07 11:40:21',
                    'updated_at' => '2024-05-07 11:40:21',
                ],
                [
                    'user_id' => '2',
                    'role_id' => '2',
                    'created_at' => '2024-05-07 11:40:21',
                    'updated_at' => '2024-05-07 11:40:21',
                ],
                [
                    'user_id' => '3',
                    'role_id' => '3',
                    'created_at' => '2024-05-07 11:40:21',
                    'updated_at' => '2024-05-07 11:40:21',
                ],
                [
                    'user_id' => '4',
                    'role_id' => '4',
                    'created_at' => '2024-05-07 11:40:21',
                    'updated_at' => '2024-05-07 11:40:21',
                ],
                [
                    'user_id' => '5',
                    'role_id' => '5',
                    'created_at' => '2024-05-07 11:40:21',
                    'updated_at' => '2024-05-07 11:40:21',
                ],

            ]);

        }
    }
}
