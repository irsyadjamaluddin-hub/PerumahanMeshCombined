<?php

namespace Database\Seeders;

use App\Models\Housing2Rekod as Rekod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Housing2RekodSeeder extends Seeder
{
    public function run(): void
    {
        $nama = ['Ahmad Fauzi bin Ismail', 'Nurul Huda binti Rahman', 'Lim Wei Sheng', 'Mohd Razif bin Othman', 'Sarah Anne Joseph'];
        $daerah = ['Kuantan', 'Kota Setar', 'Johor Bahru', 'Kota Bharu', 'Seremban'];
        $mukim = ['Mukim Beserah', 'Mukim Sungai Petani', 'Mukim Tebrau', 'Mukim Kubang Kerian', 'Mukim Labu'];
        $kelas = ['Kelas C', 'Kelas D', 'Kelas E', 'Kelas C', 'Kelas D'];
        $statuses = config('housing2.statuses');

        foreach (config('housing2.types') as $jenis => $cfg) {
            for ($i = 0; $i < 5; $i++) {
                $data = [];

                foreach ($cfg['sections'] as $section) {
                    foreach ($section['fields'] as $field) {
                        $label = $field['label'];
                        $name = Str::slug($label, '_');
                        $data[$name] = match (true) {
                            str_contains($label, 'Rujukan Fail') => 'DA/AKR/'.(2021 + $i).'/0'.(14 + $i * 3),
                            str_contains($label, 'KPP') => '8'.(20304 + $i).'-0'.($i + 1).'-512'.$i,
                            str_contains($label, 'Perhubungan') => '019-334 56'.(70 + $i),
                            str_contains($label, 'Nama') => $nama[$i],
                            str_contains($label, 'Alamat') => 'No. '.(12 + $i).', Jalan Seri Mahkota, '.$daerah[$i],
                            str_contains($label, 'Daerah') => $daerah[$i],
                            str_contains($label, 'Mukim') => $mukim[$i],
                            str_contains($label, 'Kelas') => $kelas[$i],
                            str_contains($label, 'Sewa'), str_contains($label, 'Bayaran') => 'RM '.(680 + $i * 40).'.00',
                            str_contains($label, 'Jawatan') => 'Penolong Jurutera',
                            str_contains($label, 'Bahagian') => 'Bahagian Pembangunan',
                            str_contains($label, 'Tempat Bertugas') => 'JKR Daerah '.$daerah[$i],
                            ($field['type'] ?? null) === 'date' => now()->subMonths($i * 4)->format('Y-m-d'),
                            ($field['type'] ?? null) === 'number' => (string) ($i + 1),
                            ($field['type'] ?? null) === 'file' => 'borang-permohonan.pdf',
                            str_contains($label, 'Status') => $statuses[$i % count($statuses)],
                            default => '—',
                        };
                    }
                }

                Rekod::create([
                    'jenis' => $jenis,
                    'jenis_permohonan' => ($cfg['choose'] ?? false)
                        ? array_keys($cfg['jenis_permohonan'])[$i % 2]
                        : null,
                    'status' => $statuses[$i % count($statuses)],
                    'data' => $data,
                ]);
            }
        }
    }
}
