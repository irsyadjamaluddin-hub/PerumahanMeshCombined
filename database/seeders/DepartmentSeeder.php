<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['code' => 'JKPM', 'label' => 'Jabatan Perancangan dan Kemajuan Pendidikan'],
            ['code' => 'JSS',  'label' => 'Jabatan Sekolah-Sekolah'],
            ['code' => 'JPTV', 'label' => 'Jabatan Pendidikan Teknik dan Vokasional'],
            ['code' => 'JPT',  'label' => 'Jabatan Pendidikan Tinggi'],
            ['code' => 'JPK',  'label' => 'Jabatan Perkembangan Kurikulum'],
            ['code' => 'JPP',  'label' => 'Jabatan Perkhidmatan Pendidikan'],
            ['code' => 'PTEK', 'label' => 'Pusat Teknologi Maklumat dan Komunikasi'],
            ['code' => 'PLPB', 'label' => 'Pusat Latihan Perguruan Brunei'],
            ['code' => 'BPA',  'label' => 'Bahagian Pengurusan Aset'],
            ['code' => 'BK',   'label' => 'Bahagian Kewangan'],
            ['code' => 'BP',   'label' => 'Bahagian Pentadbiran'],
        ];

        DB::table('departments')->insert($departments);
    }
}
