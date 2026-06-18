<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmploymentStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['code' => 'TTP', 'label' => 'Tetap'],
            ['code' => 'KNT', 'label' => 'Kontrak'],
            ['code' => 'SMB', 'label' => 'Sambilan'],
            ['code' => 'SMT', 'label' => 'Sementara'],
            ['code' => 'PNJ', 'label' => 'Pinjaman'],
        ];

        DB::table('employment_statuss')->insert($statuses);
    }
}
