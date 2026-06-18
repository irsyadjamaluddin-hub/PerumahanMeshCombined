<?php

namespace Database\Seeders;

use App\Models\AssetStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!AssetStatus::count()) {

            DB::table('asset_statuses')->insert([

                [
                    'name' => 'available',
                ],
                [
                    'name' => 'issued',
                ],
                [
                    'name' => 'damaged',
                ],
                [
                    'name' => 'requested for issuance',
                ],

            ]);

        }

    }
}
