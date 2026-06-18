<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MainAssetCategoryCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MainAssetCategoryCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!MainAssetCategoryCode::count()) {

            DB::table('main_asset_category_codes')->insert([
                [
                    'letter' => 'A',
                    'name' => 'Hardware',
                ],
                [
                    'letter' => 'B',
                    'name' => 'Software',
                ],
                [
                    'letter' => 'C',
                    'name' => 'Network',
                ],
                [
                    'letter' => 'D',
                    'name' => 'Facilities',
                ],
                [
                    'letter' => 'E',
                    'name' => 'Utilities',
                ],
                [
                    'letter' => 'F',
                    'name' => 'Media',
                ],
            ]);

        }
    }
}
