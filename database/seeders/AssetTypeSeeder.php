<?php

namespace Database\Seeders;

use App\Models\AssetType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!AssetType::count()) {

            DB::table('asset_types')->insert([

                [
                    'name' => 'Lejar Simpanan',
                ],
                [
                    'name' => 'Buku Daftar',
                ],

            ]);

        }
    }
}
