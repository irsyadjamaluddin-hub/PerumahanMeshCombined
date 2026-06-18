<?php

namespace Database\Seeders;

use App\Models\AnnouncementIms;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!AnnouncementIms::count()) {

            DB::table('announcement_ims')->insert([

                // ------------------------------------------
                // Category A
                // ------------------------------------------

                [
                    'message' => 'Welcome to The Inventory Management System',
                    'created_by' => '1',
                    'created_at' => '2024-05-07 11:40:21',
                    'updated_at' => '2024-05-07 11:40:21',
                ],
                [
                    'message' => 'Efficiently track and manage your inventory with the Inventory Management System (IMS).',
                    'created_by' => '1',
                    'created_at' => '2024-05-07 11:40:21',
                    'updated_at' => '2024-05-07 11:40:21',
                ],

            ]);

        }
    }
}
