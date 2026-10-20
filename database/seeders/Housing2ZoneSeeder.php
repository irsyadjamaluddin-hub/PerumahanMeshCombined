<?php

namespace Database\Seeders;

use App\Models\Housing2Staff;
use App\Models\Housing2Zone;
use App\Models\Housing2ZoneMukim;
use Illuminate\Database\Seeder;

class Housing2ZoneSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            ['kod' => 'AKR', 'nama' => 'Haji Mohd Bazil Nabil Fakhri Bin Muhd Harun', 'no_kpp' => '00-115449', 'tugas' => null],
            ['kod' => 'AKR@', 'nama' => 'Khairul Hakeem bin Hj Jumat', 'no_kpp' => '01-085277', 'tugas' => 'Menerima permohonan dan peruntukan perumahan Kerajaan Rumah Sewa & IQ'],
            ['kod' => 'AKR1', 'nama' => 'Mohammad Budiman bin Haji Hamzah', 'no_kpp' => '00-288785', 'tugas' => 'Ketua Zone 1: Rumah sewa dan IQ + penghuni'],
            ['kod' => 'AKR2', 'nama' => 'Suhainizam Bin Haji Osmar', 'no_kpp' => '00-288701', 'tugas' => 'Ketua Zone 3: Rumah sewa dan IQ + penghuni'],
            ['kod' => 'AKR3', 'nama' => 'Hazirah Binti Hamdan', 'no_kpp' => '01-040402', 'tugas' => 'Ketua Zone 2: Rumah sewa dan IQ + penghuni'],
            ['kod' => 'AKR4', 'nama' => 'Kamarulazree Bin Ahmad', 'no_kpp' => '01-042025', 'tugas' => 'Lawatan Perumahan Kerajaan'],
            ['kod' => 'AKR5', 'nama' => 'Ahmazey Bin Ahmad', 'no_kpp' => '00-299022', 'tugas' => 'Memperuntukan cadangan perumahan Kerajaan Rumah sewa dan IQ'],
            ['kod' => 'AKR6', 'nama' => 'Hajah Norinah Binti Haji Salim', 'no_kpp' => '00-266131', 'tugas' => 'Kerani Zone 1: Rumah sewa'],
            ['kod' => 'AKR7', 'nama' => 'Norasikin Binti Haji Serbini', 'no_kpp' => '00-293523', 'tugas' => 'Menerima Permohonan penyewaan Rumah Sewa Baharu'],
            ['kod' => 'AKR8', 'nama' => 'Nurul Atiqah Binti Haji Kamis', 'no_kpp' => '01-049760', 'tugas' => 'Menerima Permohonan perumahan Kerajaan'],
            ['kod' => 'AKR9', 'nama' => 'Rusni Binti Haji Bahar', 'no_kpp' => '00-111617', 'tugas' => 'Kerani Zone 3: Rumah sewa'],
            ['kod' => 'AKR10', 'nama' => 'Hajah Mahani Binti Haji Abd Salim', 'no_kpp' => '00-117446', 'tugas' => 'Kerani Zone 2: Rumah sewa'],
            ['kod' => 'AKR11', 'nama' => 'Noor Karniati Binti Haji Matassan', 'no_kpp' => '00-271385', 'tugas' => 'Pentadbiran dan mesyuarat'],
            ['kod' => 'AKR12', 'nama' => 'Noor Azura Binti Zulkifli', 'no_kpp' => '01-035704', 'tugas' => 'Kerani Zone 3: IQ'],
            ['kod' => 'AKR13', 'nama' => "Nurul Azzuin @ Mursaliza Binti Murah", 'no_kpp' => '00-317499', 'tugas' => 'Kerani Zone 1: IQ'],
            ['kod' => 'AKR14', 'nama' => 'Hajah Noorhana Binti Haji Japar', 'no_kpp' => '00-114781', 'tugas' => 'Kerani Zone 1: Rumah sewa'],
            ['kod' => 'AKR15', 'nama' => 'Pengiran Haji Mohd Jaludin Bin Pengiran Haji Puteh', 'no_kpp' => '00-119385', 'tugas' => 'Kerani Zone 1: IQ'],
            ['kod' => 'AKR16', 'nama' => 'Junaidi Gapar', 'no_kpp' => '00-124346', 'tugas' => 'Menghantar persuratan'],
            ['kod' => 'AKR17', 'nama' => 'Masdi Bin Haji Aspar', 'no_kpp' => '00-252841', 'tugas' => 'Membantu AKR 4'],
            ['kod' => 'AKR18', 'nama' => "Nur Mu'izzah Binti Abdullah Sungkai", 'no_kpp' => '00-269446', 'tugas' => 'Kerani Zone 2: IQ'],
        ];

        $staffByKod = [];
        foreach ($staff as $row) {
            $staffByKod[$row['kod']] = Housing2Staff::updateOrCreate(['kod' => $row['kod']], $row)->id;
        }

        $zoneKetua = [
            'Zone 1' => 'AKR1',
            'Zone 2' => 'AKR3',
            'Zone 3' => 'AKR2',
        ];

        $zoneIds = [];
        foreach ($zoneKetua as $nama => $ketuaKod) {
            $zoneIds[$nama] = Housing2Zone::updateOrCreate(
                ['nama' => $nama],
                ['ketua_staff_id' => $staffByKod[$ketuaKod]]
            )->id;
        }

        // Zone 1: Berakas A/B use AKR14/AKR13, the rest use AKR6/AKR15.
        $zone1 = [
            ['mukim' => 'Berakas A', 'rs' => 'AKR14', 'iq' => 'AKR13'],
            ['mukim' => 'Berakas B', 'rs' => 'AKR14', 'iq' => 'AKR13'],
            ['mukim' => 'Kota Batu', 'rs' => 'AKR6', 'iq' => 'AKR15'],
            ['mukim' => 'Serasa', 'rs' => 'AKR6', 'iq' => 'AKR15'],
            ['mukim' => 'Mentiri', 'rs' => 'AKR6', 'iq' => 'AKR15'],
            ['mukim' => 'Kilanas', 'rs' => 'AKR6', 'iq' => 'AKR15'],
            ['mukim' => 'Sengkurong', 'rs' => 'AKR6', 'iq' => 'AKR15'],
            ['mukim' => 'Sg Kebun', 'rs' => 'AKR6', 'iq' => 'AKR15'],
        ];

        $zone2 = [
            ['mukim' => 'Kianggeh', 'rs' => 'AKR10', 'iq' => 'AKR18'],
            ['mukim' => 'Gadong A', 'rs' => 'AKR10', 'iq' => 'AKR18'],
            ['mukim' => 'Gadong B', 'rs' => 'AKR10', 'iq' => 'AKR18'],
            ['mukim' => 'Lumapas', 'rs' => 'AKR10', 'iq' => 'AKR18'],
            ['mukim' => 'Pengkalan Batu', 'rs' => 'AKR10', 'iq' => 'AKR18'],
        ];

        $zone3Mukims = [
            'Keriam', 'Pekan Tutong', 'Kiudang', 'Tanjong Maya', 'Lamunin', 'Ukong', 'Rambai', 'Telisai',
            'Bangar', 'Bokok', 'Labu', 'Batu Apoi', 'Amo', 'Liang', 'Seria', 'Kuala Belait', 'Kuala Balai',
            'Labi', 'Bukit Sawat', 'Sukang',
        ];
        $zone3 = array_map(fn ($mukim) => ['mukim' => $mukim, 'rs' => 'AKR9', 'iq' => 'AKR12'], $zone3Mukims);

        $daerahByMukim = [
            'Keriam' => 'Tutong', 'Pekan Tutong' => 'Tutong', 'Kiudang' => 'Tutong', 'Tanjong Maya' => 'Tutong',
            'Lamunin' => 'Tutong', 'Ukong' => 'Tutong', 'Rambai' => 'Tutong', 'Telisai' => 'Tutong',
            'Bangar' => 'Temburong', 'Bokok' => 'Temburong', 'Labu' => 'Temburong', 'Batu Apoi' => 'Temburong', 'Amo' => 'Temburong',
            'Liang' => 'Belait', 'Seria' => 'Belait', 'Kuala Belait' => 'Belait', 'Kuala Balai' => 'Belait',
            'Labi' => 'Belait', 'Bukit Sawat' => 'Belait', 'Sukang' => 'Belait',
        ];

        foreach ([
            'Zone 1' => $zone1,
            'Zone 2' => $zone2,
        ] as $zoneName => $rows) {
            foreach ($rows as $row) {
                Housing2ZoneMukim::updateOrCreate(
                    ['zone_id' => $zoneIds[$zoneName], 'mukim' => $row['mukim']],
                    [
                        'daerah' => 'Brunei dan Muara',
                        'rs_staff_id' => $staffByKod[$row['rs']],
                        'iq_staff_id' => $staffByKod[$row['iq']],
                    ]
                );
            }
        }

        foreach ($zone3 as $row) {
            Housing2ZoneMukim::updateOrCreate(
                ['zone_id' => $zoneIds['Zone 3'], 'mukim' => $row['mukim']],
                [
                    'daerah' => $daerahByMukim[$row['mukim']] ?? 'Belait',
                    'rs_staff_id' => $staffByKod[$row['rs']],
                    'iq_staff_id' => $staffByKod[$row['iq']],
                ]
            );
        }
    }
}
