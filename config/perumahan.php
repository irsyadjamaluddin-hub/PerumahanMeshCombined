<?php

/*
 * Every register in the system. 'cols' drives the list table, 'sections' drives
 * the form and the detail view. Field input names are Str::slug(label, '_').
 * span = grid columns out of 6.
 */
return [

    'groups' => [
        'Permohonan' => ['pemohon', 'menunggu'],
        'Rumah Sewa (RS)' => ['pemilik-rs', 'penghuni-rs'],
        'Kuarters (IQ)' => ['iq', 'penghuni-iq'],
    ],

    'statuses' => ['Aktif', 'Dalam Proses', 'Diluluskan', 'Menunggu', 'Selesai'],

    'types' => [

        'pemohon' => [
            'title' => 'Senarai Pemohon',
            'short' => 'Pemohon',
            'kicker' => 'Pemohon',
            'choose' => true, // asks Rumah Sewa(RS) vs Mendapatkan Perumahan first
            'cols' => ['Nama', 'Jenis Permohonan', 'Tarikh Permohonan', 'Daerah'],
            'jenis_permohonan' => [
                'Rumah Sewa(RS)' => 'Pemilik menawarkan rumah untuk disewa oleh kerajaan.',
                'Mendapatkan Perumahan' => 'Pemohon memohon rumah sewa atau kuarters kerajaan.',
            ],
            'sections' => [
                ['title' => 'Maklumat Pemohon', 'fields' => [
                    ['label' => 'Nama Penuh Pemohon', 'span' => 6],
                    ['label' => 'No. KPP Pemohon / Warna', 'span' => 3],
                    ['label' => 'No. Perhubungan', 'span' => 3],
                    ['label' => 'Tarikh Lahir', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Bersara', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Taraf Kelamin', 'span' => 3],
                    ['label' => 'Tanggungan', 'span' => 3, 'type' => 'number'],
                    ['label' => 'Alamat Persuratan', 'span' => 6],
                    ['label' => 'Alamat Tempat Tinggal', 'span' => 6],
                ]],
                ['title' => 'Perkhidmatan', 'fields' => [
                    ['label' => 'Tempat Bertugas Pemohon', 'span' => 6],
                    ['label' => 'Jawatan', 'span' => 3],
                    ['label' => 'Bahagian', 'span' => 3],
                    ['label' => 'Tanggagaji', 'span' => 3],
                    ['label' => 'Gaji Terkini', 'span' => 3],
                    ['label' => 'Tarikh Lantikan', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Status Lantikan', 'span' => 3],
                    ['label' => 'Tempat Ditetapkan Jawatan', 'span' => 6],
                ]],
                ['title' => 'Maklumat Pasangan', 'fields' => [
                    ['label' => 'Nama Penuh Pasangan', 'span' => 6],
                    ['label' => 'No. KPP Pasangan / Warna', 'span' => 3],
                    ['label' => 'Tempat Bertugas Pasangan', 'span' => 3],
                    ['label' => 'Kementerian', 'span' => 3],
                    ['label' => 'Kemudahan Kerajaan (Jika ada)', 'span' => 3],
                ]],
                ['title' => 'Permohonan', 'fields' => [
                    ['label' => 'Tarikh Permohonan', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Status Permohonan', 'span' => 3],
                    ['label' => 'Daerah', 'span' => 3],
                    ['label' => 'Muat Naik Dokumen', 'span' => 3, 'type' => 'file'],
                ]],
            ],
        ],

        'pemilik-rs' => [
            'title' => 'Senarai Pemilik RS',
            'short' => 'Pemilik RS',
            'kicker' => 'Pemilik rumah sewa',
            'cols' => ['Rujukan Fail', 'Nama Penuh Pemilik', 'Mukim', 'Sewa Sebulan'],
            'sections' => [
                ['title' => 'Rujukan', 'fields' => [
                    ['label' => 'Rujukan Fail', 'span' => 3],
                    ['label' => 'Status', 'span' => 3],
                ]],
                ['title' => 'Maklumat Pemilik', 'fields' => [
                    ['label' => 'Nama Penuh Pemilik', 'span' => 6],
                    ['label' => 'No. KPP Pemilik', 'span' => 3],
                    ['label' => 'No. Perhubungan', 'span' => 3],
                    ['label' => 'Alamat Persuratan', 'span' => 6],
                    ['label' => 'Alamat Rumah Sewa', 'span' => 6],
                    ['label' => 'Mukim', 'span' => 3],
                    ['label' => 'Daerah', 'span' => 3],
                ]],
                ['title' => 'Sewaan', 'fields' => [
                    ['label' => 'Sewa Sebulan', 'span' => 3],
                    ['label' => 'Sewa Perabot Sebulan', 'span' => 3],
                    ['label' => 'Tarikh Mula Disewa', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Penyambungan TA', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Mansuh TA', 'span' => 3, 'type' => 'date'],
                ]],
                ['title' => 'Penghuni', 'fields' => [
                    ['label' => 'Nama Penghuni', 'span' => 6],
                    ['label' => 'Tarikh Mula Mendiami', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Mengosongkan', 'span' => 3, 'type' => 'date'],
                ]],
                ['title' => 'Dokumen', 'fields' => [
                    ['label' => 'Muat Naik Dokumen', 'span' => 3, 'type' => 'file'],
                    ['label' => 'Status Permohonan', 'span' => 3],
                ]],
            ],
        ],

        'penghuni-rs' => [
            'title' => 'Senarai Penghuni RS',
            'short' => 'Penghuni RS',
            'kicker' => 'Penghuni rumah sewa',
            'cols' => ['Nama Penuh Penghuni', 'No. KPP Penghuni / Warna', 'Alamat Rumah Sewa', 'Tarikh Mula Mendiami'],
            'sections' => [
                ['title' => 'Maklumat Penghuni', 'fields' => [
                    ['label' => 'Nama Penuh Penghuni', 'span' => 6],
                    ['label' => 'No. KPP Penghuni / Warna', 'span' => 3],
                    ['label' => 'No. Perhubungan', 'span' => 3],
                    ['label' => 'Tarikh Lahir', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Bersara', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Taraf Kelamin', 'span' => 3],
                    ['label' => 'Tempat Bertugas', 'span' => 3],
                ]],
                ['title' => 'Perkhidmatan', 'fields' => [
                    ['label' => 'Jawatan', 'span' => 3],
                    ['label' => 'Bahagian', 'span' => 3],
                    ['label' => 'Tanggagaji', 'span' => 3],
                    ['label' => 'Gaji Terkini', 'span' => 3],
                    ['label' => 'Tarikh Lantikan', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Status Lantikan', 'span' => 3],
                ]],
                ['title' => 'Maklumat Pasangan', 'fields' => [
                    ['label' => 'Nama Penuh Pasangan', 'span' => 6],
                    ['label' => 'Tempat Bertugas Pasangan', 'span' => 3],
                    ['label' => 'Kementerian', 'span' => 3],
                ]],
                ['title' => 'Rumah Sewa', 'fields' => [
                    ['label' => 'Alamat Rumah Sewa', 'span' => 6],
                    ['label' => 'Daerah', 'span' => 3],
                    ['label' => 'Nama Pemilik', 'span' => 3],
                    ['label' => 'Kelas', 'span' => 2],
                    ['label' => 'Sewa Sebulan', 'span' => 2],
                    ['label' => 'Sewa Sebulan Perabot', 'span' => 2],
                    ['label' => 'Tarikh Mula Mendiami', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Mengosongkan', 'span' => 3, 'type' => 'date'],
                ]],
            ],
        ],

        'iq' => [
            'title' => 'Senarai IQ',
            'short' => 'IQ',
            'kicker' => 'Perumahan kerajaan',
            'cols' => ['Rujukan Fail', 'Alamat Perumahan Kerajaan (IQ)', 'Kelas', 'Jenis IQ'],
            'sections' => [
                ['title' => 'Rujukan', 'fields' => [
                    ['label' => 'Rujukan Fail', 'span' => 3],
                    ['label' => 'Status', 'span' => 3],
                ]],
                ['title' => 'Maklumat Perumahan (IQ)', 'fields' => [
                    ['label' => 'Alamat Perumahan Kerajaan (IQ)', 'span' => 6],
                    ['label' => 'Daerah', 'span' => 3],
                    ['label' => 'Blok', 'span' => 3],
                    ['label' => 'Kelas', 'span' => 3],
                    ['label' => 'Jenis IQ', 'span' => 3],
                    ['label' => 'Sewa Sebulan', 'span' => 3],
                    ['label' => 'Pembekalan Perabot', 'span' => 3],
                    ['label' => 'Jumlah Bilik', 'span' => 3, 'type' => 'number'],
                    ['label' => 'Jumlah Tandas', 'span' => 3, 'type' => 'number'],
                ]],
                ['title' => 'Penghuni', 'fields' => [
                    ['label' => 'Nama Penuh Penghuni', 'span' => 6],
                    ['label' => 'No. KPP Penghuni / Warna', 'span' => 3],
                    ['label' => 'Jawatan', 'span' => 3],
                    ['label' => 'Tempat Bertugas', 'span' => 3],
                    ['label' => 'Tarikh Mula Mendiami', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Mengosongkan', 'span' => 3, 'type' => 'date'],
                ]],
                ['title' => 'Dokumen', 'fields' => [
                    ['label' => 'Muat Naik Dokumen', 'span' => 6, 'type' => 'file'],
                ]],
            ],
        ],

        'penghuni-iq' => [
            'title' => 'Senarai Penghuni IQ',
            'short' => 'Penghuni IQ',
            'kicker' => 'Penghuni kuarters',
            'cols' => ['Nama Penuh Penghuni', 'Jawatan', 'Alamat Perumahan Kerajaan (IQ)', 'Tarikh Mula Mendiami'],
            'sections' => [
                ['title' => 'Maklumat Penghuni', 'fields' => [
                    ['label' => 'Nama Penuh Penghuni', 'span' => 6],
                    ['label' => 'No. KPP Penghuni / Warna', 'span' => 3],
                    ['label' => 'No. Perhubungan', 'span' => 3],
                    ['label' => 'Tarikh Lahir', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Bersara', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Taraf Kelamin', 'span' => 3],
                    ['label' => 'Tanggungan', 'span' => 3, 'type' => 'number'],
                    ['label' => 'Tempat Bertugas', 'span' => 6],
                ]],
                ['title' => 'Perkhidmatan', 'fields' => [
                    ['label' => 'Jawatan', 'span' => 3],
                    ['label' => 'Bahagian', 'span' => 3],
                    ['label' => 'Tanggagaji', 'span' => 3],
                    ['label' => 'Gaji Terkini', 'span' => 3],
                    ['label' => 'Tarikh Lantikan', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Status Lantikan', 'span' => 3],
                ]],
                ['title' => 'Perumahan Kerajaan', 'fields' => [
                    ['label' => 'Alamat Perumahan Kerajaan (IQ)', 'span' => 6],
                    ['label' => 'Daerah', 'span' => 3],
                    ['label' => 'Kelas', 'span' => 3],
                    ['label' => 'Bayaran Sebulan', 'span' => 2],
                    ['label' => 'Dibekal Perabot', 'span' => 2],
                    ['label' => 'Status', 'span' => 2],
                    ['label' => 'Tarikh Mula Mendiami', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Mengosongkan', 'span' => 3, 'type' => 'date'],
                ]],
            ],
        ],

        'menunggu' => [
            'title' => 'Senarai Menunggu',
            'short' => 'Menunggu',
            'kicker' => 'Senarai menunggu',
            'cols' => ['Nama Penuh Pemohon', 'Kelayakan Perumahan', 'Tarikh Permohonan', 'Daerah'],
            'sections' => [
                ['title' => 'Maklumat Pemohon', 'fields' => [
                    ['label' => 'Nama Penuh Pemohon', 'span' => 6],
                    ['label' => 'No. KPP Pemohon / Warna', 'span' => 3],
                    ['label' => 'No. Perhubungan', 'span' => 3],
                    ['label' => 'Tarikh Lahir', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Bersara', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Taraf Kelamin', 'span' => 3],
                    ['label' => 'Tanggungan', 'span' => 3, 'type' => 'number'],
                ]],
                ['title' => 'Perkhidmatan', 'fields' => [
                    ['label' => 'Tempat Bertugas Pemohon', 'span' => 6],
                    ['label' => 'Jawatan', 'span' => 3],
                    ['label' => 'Bahagian', 'span' => 3],
                    ['label' => 'Tanggagaji', 'span' => 3],
                    ['label' => 'Jenis Perkhidmatan', 'span' => 3],
                ]],
                ['title' => 'Permohonan', 'fields' => [
                    ['label' => 'Kategori Permohonan', 'span' => 3],
                    ['label' => 'Daerah', 'span' => 3],
                    ['label' => 'Kelayakan Perumahan', 'span' => 3],
                    ['label' => 'Kelayakan Kelas', 'span' => 3],
                    ['label' => 'Tarikh Permohonan', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Tarikh Diterima', 'span' => 3, 'type' => 'date'],
                    ['label' => 'Muat Naik Dokumen', 'span' => 6, 'type' => 'file'],
                ]],
            ],
        ],
    ],
];
