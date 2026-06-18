<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        $divisions = [
            ['code' => 'GG1', 'label' => 'Guru Gred 1'],
            ['code' => 'GG2', 'label' => 'Guru Gred 2'],
            ['code' => 'GG3', 'label' => 'Guru Gred 3'],
            ['code' => 'GK',  'label' => 'Guru Kanan'],
            ['code' => 'GC',  'label' => 'Guru Cemerlang'],
            ['code' => 'PN',  'label' => 'Pengetua'],
            ['code' => 'TPB', 'label' => 'Timbalan Pengetua'],
            ['code' => 'KA',  'label' => 'Kumpulan A'],
            ['code' => 'KB',  'label' => 'Kumpulan B'],
            ['code' => 'KC',  'label' => 'Kumpulan C'],
            ['code' => 'KD',  'label' => 'Kumpulan D'],
        ];

        DB::table('divisions')->insert($divisions);
    }
}
