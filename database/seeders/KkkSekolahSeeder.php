<?php

namespace Database\Seeders;

use App\Models\Kkk\KkkSekolah;
use Illuminate\Database\Seeder;

/**
 * Official school list from "Rujukan Fail untuk Kluster 1–6" (Unit Audit Dalaman).
 * Safe to re-run: schools are matched by Rujukan Fail, or by name for schools
 * that were entered before Rujukan Fail existed.
 */
class KkkSekolahSeeder extends Seeder
{
    protected const SENARAI = [
        1 => [
            'Maktab Duli Pengiran Muda Al Muhtadee Billah',
            'Sekolah Menengah Awang Semaun',
            'Sekolah Menengah Sultan Hassan',
            'Sekolah Menengah Sayyidina Umar Al-Khattab',
            'Sekolah Rendah Amo',
            'Sekolah Rendah Bendahara Lama',
            'Sekolah Rendah Hj Tarif',
            'Sekolah Rendah Junjongan',
            'Sekolah Rendah Kasat',
            'Sekolah Rendah Labu Estate',
            'Sekolah Rendah Lumapas',
            'Sekolah Rendah Negalang',
            'Sekolah Rendah PAP Besar Sungai Kebun',
            'Sekolah Rendah Pintu Malim',
            'Sekolah Rendah Puni',
            'Sekolah Rendah Putat',
            'Sekolah Rendah Rataie',
            'Sekolah Rendah Saba Darat',
            'Sekolah Rendah Selangan',
            'Sekolah Rendah Selapon',
            'Sekolah Rendah Sultan Hashim Batu Apoi',
            'Sekolah Rendah Sultan Hassan Bangar',
            'Sekolah Rendah Sungai Siamas',
        ],
        2 => [
            'Pusat Tingkatan Enam Meragang',
            'Maktab Sultan Omar Ali Saifuddien',
            'Sekolah Menengah Pehin Datu Seri Maharaja',
            'Sekolah Menengah Pengiran Anak Puteri Hjh Masna',
            'Sekolah Menengah Pengiran Isteri Hajah Mariam',
            'Sekolah Menengah Sultan Muhammad Jamalul Alam',
            'Sekolah Menengah Sultan Sharif Ali',
            'Sekolah Tinggi Perempuan Raja Isteri',
            'Sekolah Rendah Batu Marang',
            'Sekolah Rendah Dato Mohd Yassin',
            'Sekolah Rendah Dato Ratna Hj Mohd Jaafar',
            'Sekolah Rendah Hj Mohd Jaafar Maun, Kiulap',
            'Sekolah Rendah Hj Mohd Salleh Sg Hanching',
            'Sekolah Rendah Kapok',
            'Sekolah Rendah Mabohai',
            'Sekolah Rendah Mentiri',
            'Sekolah Rendah Nakhoda Abdul Rashid Menunggol',
            'Sekolah Rendah Orang Kaya Besar Imas Subok',
            'Sekolah Rendah Pusar Ulak',
            'Sekolah Rendah Raja Isteri Fatimah',
            'Sekolah Rendah Serasa',
            'Sekolah Rendah Sultan Abdul Bubin Sg Besar',
            'Sekolah Rendah Sultan Umar Ali Saifuddien Muara',
            'Sekolah Rendah Tanah Jambu',
            'Sekolah Rendah Tanjong Kindana',
            'Sekolah Rendah Tentera Laut Diraja Brunei, Muara',
        ],
        3 => [
            'Maktab Sains Paduka Seri Begawan Sultan',
            'Sekolah Menengah Berakas',
            'Sekolah Menengah Lambak Kiri',
            'Sekolah Menengah Menglait',
            'Sekolah Menengah Rimba',
            'Sekolah Menengah Rimba 2',
            'Sekolah Menengah Sayyidina Abu Bakar',
            'Sekolah Sukan',
            'Sekolah Rendah Amar Pahlawan',
            'Sekolah Rendah Anggerek Desa',
            'Sekolah Rendah Berakas Garison',
            'Sekolah Rendah Dato Basir',
            'Sekolah Rendah Dato Marsal',
            'Sekolah Rendah Dato Othman',
            'Sekolah Rendah Datu Mahawangsa Lambak',
            'Sekolah Rendah Delima Satu',
            'Sekolah Rendah Kampong Mata-Mata',
            'Sekolah Rendah Lambak Kanan Jalan 49',
            'Sekolah Rendah Pantai Berakas',
            'Sekolah Rendah Perpindahan Kampong Lambak Kanan Jalan 10',
            'Sekolah Rendah Pg Perkerma Setia Diraja Sahibul Bandar',
            'Sekolah Rendah Pulaie',
            'Sekolah Rendah Rimba 1',
            'Sekolah Rendah Rimba 2',
            'Sekolah Rendah Rimba 3',
            'Sekolah Rendah Tungku',
        ],
        4 => [
            'Pusat Tingkatan Enam Sengkurong',
            'Sekolah Menengah Katok',
            'Sekolah Menengah Masin',
            'Sekolah Menengah Sayyidina Hasan',
            'Sekolah Menengah Sayyidina Husain',
            'Sekolah Rendah Awang Hj Mohd Yusof Katimahar',
            'Sekolah Rendah Bebuloh',
            'Sekolah Rendah Bendahara Sakam, Bunut',
            'Sekolah Rendah Bengkurong',
            'Sekolah Rendah Beribi Telanai',
            'Sekolah Rendah Jerudong',
            'Sekolah Rendah Katok A',
            'Sekolah Rendah Katok B',
            'Sekolah Rendah Masin',
            'Sekolah Rendah Mulaut',
            'Sekolah Rendah Orang Kaya Setia Bakti, Kilanas',
            'Sekolah Rendah Panchor Murai',
            'Sekolah Rendah Panglima Berudin Limau Manis',
            'Sekolah Rendah Pengkalan Batu',
            'Sekolah Rendah Sengkurong',
        ],
        5 => [
            'Pusat Tingkatan Enam, Tutong',
            'Sekolah Menengah Muda Hashim',
            'Sekolah Menengah Raja Isteri Pengiran Anak Saleha',
            "Sekolah Menengah Sayyidina 'Othman",
            'Sekolah Menengah Sufri Bolkiah',
            'Sekolah Menengah Tanjong Maya',
            'Sekolah Rendah Abd Rashid Tanjong Maya',
            'Sekolah Rendah Bakiau',
            'Sekolah Rendah Batang Mitus',
            'Sekolah Rendah Benutan',
            'Sekolah Rendah Binturan',
            'Sekolah Rendah Birau',
            'Sekolah Rendah Bukit Panggal',
            'Sekolah Rendah Bukit Udal',
            'Sekolah Rendah Danau',
            'Sekolah Rendah Dato Pemancha Saging Ukong',
            'Sekolah Rendah Kampong Bukit',
            'Sekolah Rendah Kampong Menengah',
            'Sekolah Rendah Keriam',
            'Sekolah Rendah Kiudang',
            'Sekolah Rendah Lamunin',
            'Sekolah Rendah Lubok Pulau',
            'Sekolah Rendah Muda Hashim',
            'Sekolah Rendah Orang Kaya Ali Wanika Setia Di-Raja, Kupang',
            'Sekolah Rendah Panchong',
            'Sekolah Rendah Penanjong',
            'Sekolah Rendah Penapar',
            'Sekolah Rendah Pengiran Kesuma Negara Bukit Beruang',
            'Sekolah Rendah Perpindahan Kampung Bukit Beruang II',
            'Sekolah Rendah Pg Dipa Negara Pg Jaya Sengkarai',
            'Sekolah Rendah Pg Muda Mahkota',
            'Sekolah Rendah Rambai',
            'Sekolah Rendah Sinaut',
            'Sekolah Rendah Tumpuan Telisai',
            'Sekolah Rendah Tutong Kem',
        ],
        6 => [
            'Pusat Tingkatan Enam Belait',
            'Maktab Anthony Abell',
            "Sekolah Menengah Pengiran Anak Puteri Hjh Rashidah Sa'adatul Bolkiah",
            'Sekolah Menengah Pengiran Jaya Negara Pengiran Hj Abu Bakar',
            'Sekolah Menengah Perdana Wazir',
            'Sekolah Menengah Sayyidina Ali',
            'Sekolah Rendah Ahmad Tajuddin',
            'Sekolah Rendah Kuala Belait',
            'Sekolah Rendah Labi',
            'Sekolah Rendah Lumut',
            'Sekolah Rendah Merangking',
            'Sekolah Rendah Muhammad Alam',
            'Sekolah Rendah Paduka Seri Begawan SOAS',
            'Sekolah Rendah Panaga',
            'Sekolah Rendah Pg Setia Jaya Pg Hj Abdul Momin',
            'Sekolah Rendah Pg Setia Negara Pg Mohd Yusof',
            'Sekolah Rendah Sungai Liang',
            'Sekolah Rendah Sungai Tali Lumut II',
            'Sekolah Rendah Sungai Teraban',
        ],
    ];

    public function run(): void
    {
        $sedia = KkkSekolah::all();

        foreach (self::SENARAI as $kluster => $sekolahs) {
            foreach ($sekolahs as $i => $nama) {
                $kod = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
                $rujukan = "KP/UAD/K{$kluster}-{$kod}";

                $sekolah = $sedia->first(fn ($s) => $s->rujukan_fail === $rujukan)
                    ?? $sedia->first(fn ($s) => ! $s->rujukan_fail && self::kunci($s->nama) === self::kunci($nama))
                    ?? new KkkSekolah(['peringkat' => self::peringkat($nama), 'aktif' => true]);

                $sekolah->fill(['nama' => $nama, 'kod' => $kod, 'rujukan_fail' => $rujukan, 'kluster' => $kluster])->save();
            }
        }
    }

    /** Name comparison that ignores case, spacing and punctuation ("Al-Muhtadee" = "Al Muhtadee"). */
    protected static function kunci(string $nama): string
    {
        return preg_replace('/[^a-z0-9]/', '', strtolower($nama));
    }

    protected static function peringkat(string $nama): string
    {
        return match (true) {
            str_starts_with($nama, 'Pusat Tingkatan Enam') => 'Pusat Tingkatan Enam',
            str_starts_with($nama, 'Sekolah Rendah') => 'Rendah',
            default => 'Menengah',
        };
    }
}
