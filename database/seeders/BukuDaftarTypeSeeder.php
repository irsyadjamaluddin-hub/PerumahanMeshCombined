<?php

namespace Database\Seeders;

use App\Models\BukuDaftarType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuDaftarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!BukuDaftarType::count()) {

            DB::table('buku_daftar_types')->insert([

                [
                    'name' => 'Daftar Barang-Barang (Fixed Asset)',
                ],
                [
                    'name' => 'Guna Habis (Consumable)',
                ],

            ]);

        }
    }
}
