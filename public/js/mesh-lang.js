// #========== NEWLY ADDED ============
/* ==========================================================================
   MESH English / Malay switch (Oct 2026)

   Button: resources/views/inc/lang-toggle.blade.php (header of layouts/app-all
   and layouts/app-pdms). Loaded at the end of <body> by both layouts.

   How it works: the pages stay written in English. When BM is picked, this
   swaps every text, placeholder, aria-label and title that is in the MS list
   below for its Malay version, including text added later (popups, the bell
   count, the dark mode button label), and puts the English back for EN.
   Only exact matches are swapped, so names, data typed by users and table
   contents are left alone. The choice is saved in localStorage 'mesh-lang'
   and applied again on every page (inc/lang-head.blade.php hides the page
   for that moment so it doesn't flash English first).

   To translate more text: add  'English text': 'Teks Melayu',  to MS.
   ========================================================================== */
// #========== NEWLY ADDED ============
// Oct 2026: also loaded by layouts/app, app2, app3, hrs/layouts/app, hrs/layouts/app-minimal (floating button,
// inc/lang-float.blade.php) and hrs/layouts/landing (header button). New text goes in MORE below; matching now
// ignores letter case and labels ending in ":" or "*", and translates table counters ("Showing 1 to 10 of 50 entries").
// #================================
// #========== NEWLY ADDED ============
// Oct 2026: both directions. BM turns English text into Malay (MS / MORE lists); EN turns Malay text into English
// (EN list) for pages written in Malay. EN is the default, so Malay pages now show in English unless BM is picked.
// #================================
(function () {
  'use strict';

  var MS = {
    // Header, user menu, footer
    'Ministry of Education · Employee & Services Hub (MESH)': 'Kementerian Pendidikan · Hab Pekerja & Perkhidmatan (MESH)',
    'Toggle menu': 'Buka/tutup menu',
    'Switch to dark mode': 'Tukar ke mod gelap',
    'Switch to light mode': 'Tukar ke mod cerah',
    'Language': 'Bahasa',
    'My Profile': 'Profil Saya',
    'Change Password': 'Tukar Kata Laluan',
    'Sign Out': 'Log Keluar',
    'Ministry of Education © 2026 All Rights Reserved. Powered by DevOps ICT.': 'Kementerian Pendidikan © 2026 Hak Cipta Terpelihara. Dikuasakan oleh DevOps ICT.',

    // Announcements bell (inc/announcement-bell.blade.php + inc/announcement-bell-modals.blade.php)
    'Announcements': 'Pengumuman',
    'Mark all as read': 'Tandakan semua sudah dibaca',
    'There are currently no announcements.': 'Tiada pengumuman buat masa ini.',
    'Email me new announcements': 'E-melkan pengumuman baharu kepada saya',
    'Stop email notifications': 'Hentikan pemberitahuan e-mel',
    'Click to receive notification in email': 'Klik untuk menerima pemberitahuan melalui e-mel',
    'Click to disable receiving notification in email': 'Klik untuk berhenti menerima pemberitahuan melalui e-mel',
    'View all': 'Lihat semua',
    'All announcements': 'Semua pengumuman',
    'Information': 'Maklumat',
    'Maintenance': 'Penyelenggaraan',
    'Update': 'Kemas Kini',
    'Urgent': 'Segera',

    // Sidebar (layouts/app-all.blade.php)
    'Admin Home': 'Laman Utama Pentadbir',
    'Main Menu': 'Menu Utama',
    'Home': 'Laman Utama',
    'Profile': 'Profil',
    'Dashboard': 'Papan Pemuka',
    'Admin': 'Pentadbir',
    'Super Admin': 'Pentadbir Super',
    'Users': 'Pengguna',
    'Role': 'Peranan',
    'Users Report': 'Laporan Pengguna',
    'ART Report': 'Laporan ART',
    'PPS Visitors': 'Pelawat PPS',
    'JPKK Report': 'Laporan JPKK',
    'SJK Report': 'Laporan SJK',
    'ONS Report': 'Laporan ONS',
    'Tegahan Report': 'Laporan Tegahan',
    'GenAI Report': 'Laporan GenAI',
    'List/Verify': 'Senarai/Sahkan',
    'Assigned Role': 'Peranan Diberikan',
    'Request Role': 'Mohon Peranan',

    // Sidebar (layouts/app-pdms.blade.php)
    'PDMS Access': 'Akses PDMS',
    'PDMS Home': 'Laman Utama PDMS',
    'MESH Home': 'Laman Utama MESH',
    'PDMS Cuti Records': 'Rekod Cuti PDMS',
    'PDMS Service Records': 'Rekod Perkhidmatan PDMS',
    'PDMS Admin': 'Pentadbir PDMS',

    // Greeting (inc/home-greeting.blade.php)
    'Good morning': 'Selamat pagi',
    'Good afternoon': 'Selamat petang',
    'Good evening': 'Selamat malam',

    // Services (inc/home-services.blade.php)
    'Services': 'Perkhidmatan',
    'Search services': 'Cari perkhidmatan',
    'Human Resource': 'Sumber Manusia',
    'Communication & Notifications': 'Komunikasi & Pemberitahuan',
    'Attendance & Events': 'Kehadiran & Acara',
    'Operations': 'Operasi',
    'Facilities & Support': 'Kemudahan & Sokongan',
    'Human Resource System': 'Sistem Sumber Manusia',
    'MESH Notification Service': 'Perkhidmatan Pemberitahuan MESH',
    'MESH Link Sharing': 'Perkongsian Pautan MESH',
    'File Sharing Drive': 'Perkongsian Fail',
    'MESH Event Attendance': 'Kehadiran Acara MESH',
    'MESH Attendance Slip': 'Slip Kehadiran MESH',
    'Q&A Service': 'Perkhidmatan Soal Jawab',
    'Curriculum Materials Service': 'Perkhidmatan Bahan Kurikulum',
    'Co-Curriculum Activities Management': 'Pengurusan Aktiviti Kokurikulum',
    'Documentation Flow': 'Aliran Dokumentasi',
    'Facility Booking Management': 'Pengurusan Tempahan Kemudahan',
    'Support Request': 'Permohonan Sokongan',
    'Role Access': 'Akses Peranan',
    'Manage and activate SSM accounts, update personal information and documents, and submit enquiries related to SSM services.': 'Urus dan aktifkan akaun SSM, kemas kini maklumat peribadi dan dokumen, serta hantar pertanyaan berkaitan perkhidmatan SSM.',
    'Broadcast official messages and documents to multiple recipients simultaneously via WhatsApp using the WhatsApp API.': 'Hantar mesej dan dokumen rasmi kepada ramai penerima serentak melalui WhatsApp menggunakan API WhatsApp.',
    'Generate shortened links and QR codes for easy sharing and reference.': 'Jana pautan pendek dan kod QR untuk mudah dikongsi dan dirujuk.',
    'Upload, organize and share files and folders.': 'Muat naik, susun dan kongsi fail serta folder.',
    'Manage attendance for Ministry activities, including participant check-in and attendance records for meetings, discussions, training sessions, and other official activities.': 'Urus kehadiran bagi aktiviti Kementerian, termasuk daftar masuk peserta dan rekod kehadiran untuk mesyuarat, perbincangan, sesi latihan dan aktiviti rasmi lain.',
    'Attendance slips for Ministry events and training sessions.': 'Slip kehadiran untuk acara dan sesi latihan Kementerian.',
    'Submit questions anonymously for training or event purposes.': 'Hantar soalan tanpa nama untuk tujuan latihan atau acara.',
    'Manage applications and services related to curriculum materials.': 'Urus permohonan dan perkhidmatan berkaitan bahan kurikulum.',
    'Manage and coordinate co-curricular activities.': 'Urus dan selaras aktiviti kokurikulum.',
    'Create, track, and action official e-memos routed to your department.': 'Cipta, jejak dan ambil tindakan ke atas e-memo rasmi yang dihantar ke jabatan anda.',
    'Reserve meeting and syndicate rooms within the Ministry of Education for internal meetings and activities.': 'Tempah bilik mesyuarat dan bilik sindiket di Kementerian Pendidikan untuk mesyuarat dan aktiviti dalaman.',
    'Get technical support and assistance from the DevOps Support Desk.': 'Dapatkan sokongan teknikal dan bantuan daripada Meja Sokongan DevOps.',
    'Request or review the MESH roles and permission levels assigned to your account.': 'Mohon atau semak peranan dan tahap kebenaran MESH yang diberikan kepada akaun anda.',
    'Open': 'Buka',
    'View options': 'Lihat pilihan',
    'Access required': 'Akses diperlukan',
    'D Flow waiting for your action': 'D Flow menunggu tindakan anda',

    // Service popups
    'Close': 'Tutup',
    'Activate SSM Account': 'Aktifkan Akaun SSM',
    'SSM Enquiries': 'Pertanyaan SSM',
    'Leave': 'Cuti',
    'Acting': 'Memangku',
    'Retirement': 'Bersara',
    'Coming Soon': 'Akan Datang',
    'Coming soon!': 'Akan datang!',
    'D Flow Action': 'Tindakan D Flow',
    'List of D Flow': 'Senarai D Flow',
    'Create D Flow': 'Cipta D Flow',
    'D Flow (Action)': 'D Flow (Tindakan)',
    'Settings': 'Tetapan',
    'Meeting Room Booking': 'Tempahan Bilik Mesyuarat',
    'Syndicate Room Booking': 'Tempahan Bilik Sindiket',
    'MRB - Meeting Room Booking': 'MRB - Tempahan Bilik Mesyuarat',
    'Search Room Availability': 'Cari Kekosongan Bilik',
    'Calendar': 'Kalendar',
    'Booking': 'Tempahan',
    'Room': 'Bilik',
    'Back': 'Kembali',
    'DevOps Support Service': 'Perkhidmatan Sokongan DevOps',
    'DevOps Request Form': 'Borang Permohonan DevOps'
  };

  // #========== NEWLY ADDED ============
  // More text (Oct 2026), so BM reaches other pages too, not just Home. Picked from the text that appears most
  // across the Blade views, plus the Admin / Super Admin pages and the most-used services. Text that is already
  // in Malay on the pages is left out. Entries here never replace one in MS above.
  var MORE = {
    // Buttons and actions used on most pages
    'Submit': 'Hantar',
    'Save': 'Simpan',
    'Save Changes': 'Simpan Perubahan',
    'Cancel': 'Batal',
    'Edit': 'Ubah',
    'Delete': 'Padam',
    'Remove': 'Buang',
    'Add': 'Tambah',
    'Add New': 'Tambah Baharu',
    'Create': 'Cipta',
    'View': 'Lihat',
    'View Details': 'Lihat Butiran',
    'Details': 'Butiran',
    'Search': 'Cari',
    'Search...': 'Cari...',
    'Search ...': 'Cari ...',
    'Search Bar': 'Bar Carian',
    'Search by': 'Cari mengikut',
    'Filter': 'Tapis',
    'Reset': 'Set Semula',
    'Clear': 'Kosongkan',
    'Confirm': 'Sahkan',
    'Verify': 'Sahkan',
    'Approve': 'Luluskan',
    'Reject': 'Tolak',
    'Send': 'Hantar',
    'Copy': 'Salin',
    'Print': 'Cetak',
    'Download': 'Muat Turun',
    'Upload': 'Muat Naik',
    'Export Excel': 'Eksport Excel',
    'Export PDF': 'Eksport PDF',
    'Read More': 'Baca Lagi',
    'Select': 'Pilih',
    'Select type': 'Pilih jenis',
    'Select action': 'Pilih tindakan',
    'Select Category': 'Pilih Kategori',
    'Choose File': 'Pilih Fail',
    'No file chosen': 'Tiada fail dipilih',
    'Next': 'Seterusnya',
    'Previous': 'Sebelumnya',
    'First': 'Pertama',
    'Last': 'Terakhir',
    'Next »': 'Seterusnya »',
    '« Previous': '« Sebelumnya',
    'Logout': 'Log Keluar',
    'Login': 'Log Masuk',
    'Action': 'Tindakan',
    'Actions': 'Tindakan',
    'Book': 'Tempah',
    'Book Room': 'Tempah Bilik',
    'Grant Access': 'Beri Akses',

    // Status words
    'Approved': 'Diluluskan',
    'Rejected': 'Ditolak',
    'Pending': 'Belum Selesai',
    'Completed': 'Selesai',
    'Active': 'Aktif',
    'Inactive': 'Tidak Aktif',
    'Archived': 'Diarkibkan',
    'Not Yet Received': 'Belum Diterima',

    // Table and form labels
    'Name': 'Nama',
    'Full Name': 'Nama Penuh',
    'Fullname': 'Nama Penuh',
    'Date': 'Tarikh',
    'Time': 'Masa',
    'Start': 'Mula',
    'End': 'Tamat',
    'Start Time': 'Masa Mula',
    'End Time': 'Masa Tamat',
    'Date Start': 'Tarikh Mula',
    'Date End': 'Tarikh Tamat',
    'Title': 'Tajuk',
    'Subject': 'Perkara',
    'Description': 'Keterangan',
    'Remarks': 'Catatan',
    'Remark': 'Catatan',
    'Category': 'Kategori',
    'Type': 'Jenis',
    'Email': 'E-mel',
    'Phone Number': 'Nombor Telefon',
    'Phone No': 'No. Telefon',
    'Telephone No.': 'No. Telefon',
    'Tel No': 'No. Tel',
    'Address': 'Alamat',
    'Department': 'Jabatan',
    'Dept': 'Jabatan',
    'Division': 'Bahagian',
    'Section': 'Seksyen',
    'Position': 'Jawatan',
    'Designation': 'Jawatan',
    'School': 'Sekolah',
    'District': 'Daerah',
    'Gender': 'Jantina',
    'Male': 'Lelaki',
    'Female': 'Perempuan',
    'Race': 'Bangsa',
    'Religion': 'Agama',
    'Citizenship': 'Kerakyatan',
    'Date of Birth': 'Tarikh Lahir',
    'Place of Birth': 'Tempat Lahir',
    'Marital Status': 'Taraf Perkahwinan',
    'Martial Status': 'Taraf Perkahwinan',
    'Date of Retirement': 'Tarikh Bersara',
    'IC No.': 'No. K/P',
    'IC No': 'No. K/P',
    'IC Number': 'Nombor K/P',
    'Identity Card No.': 'No. Kad Pengenalan',
    'Identity Number': 'Nombor Pengenalan',
    'Enter IC Number': 'Masukkan Nombor K/P',
    'Year': 'Tahun',
    'User': 'Pengguna',
    'Staff': 'Kakitangan',
    'Student': 'Pelajar',
    'Created At': 'Dicipta Pada',
    'Updated At': 'Dikemas Kini Pada',
    'Created By': 'Dicipta Oleh',
    'Prepared By': 'Disediakan Oleh',
    'File': 'Fail',
    'File Name': 'Nama Fail',
    'Document': 'Dokumen',
    'Documents': 'Dokumen',
    'From': 'Daripada',
    'To': 'Kepada',
    'By': 'Oleh',
    'Code': 'Kod',
    'Message': 'Mesej',
    'Message Details': 'Butiran Mesej',
    'Feedback': 'Maklum Balas',
    'Rating': 'Penilaian',
    'Ratings': 'Penilaian',
    'Overall Rating': 'Penilaian Keseluruhan',
    'Questions': 'Soalan',
    'Organisation': 'Organisasi',
    'Salary': 'Gaji',
    'Salary Scale': 'Skala Gaji',
    'Grade': 'Gred',
    'Performance': 'Prestasi',
    'Personal Details': 'Butiran Peribadi',
    'Contact': 'Hubungi',
    'Venue': 'Tempat',
    'Capacity': 'Kapasiti',
    'Internal': 'Dalaman',
    'Ministry': 'Kementerian',
    'Ministry of Education': 'Kementerian Pendidikan',
    'Type of Leave': 'Jenis Cuti',
    'Type of Service': 'Jenis Perkhidmatan',
    'Reference No': 'No. Rujukan',
    'Reference No.': 'No. Rujukan',
    'Correspondence Reference': 'Rujukan Persuratan',
    'Department Reference': 'Rujukan Jabatan',
    'Status Information': 'Maklumat Status',
    'Appointment Letter': 'Surat Lantikan',
    'Reporting Letter': 'Surat Melapor Diri',
    'Upload Identification Card': 'Muat Naik Kad Pengenalan',
    'Upload Appointment Letter': 'Muat Naik Surat Lantikan',
    'Upload Work Report Letter': 'Muat Naik Surat Melapor Diri',
    'View Uploaded File': 'Lihat Fail Dimuat Naik',

    // Messages
    'No records found': 'Tiada rekod ditemui',
    'No records found!': 'Tiada rekod ditemui!',
    'Confirm Deletion': 'Sahkan Pemadaman',
    'Are you sure you want to delete this record?': 'Adakah anda pasti mahu memadam rekod ini?',
    'You must agree before submitting.': 'Anda mesti bersetuju sebelum menghantar.',
    'Upload Validation Error': 'Ralat Pengesahan Muat Naik',
    'Drag and drop files here or click to browse': 'Seret dan lepas fail di sini atau klik untuk memilih',
    'Only File up to 10MB size is accepted': 'Hanya fail sehingga 10MB diterima',
    'Leave empty if not adding a new document.': 'Biarkan kosong jika tidak menambah dokumen baharu.',
    'Leave empty if there is no new document.': 'Biarkan kosong jika tiada dokumen baharu.',
    'Enter Text...': 'Masukkan Teks...',
    'Enter the answer': 'Masukkan jawapan',

    // Tables (DataTables / simple-datatables / Laravel pagination); counts are in PATTERNS below
    'Show': 'Papar',
    'entries': 'rekod',
    'entries per page': 'rekod setiap halaman',
    'No data available in table': 'Tiada data dalam jadual',
    'No matching records found': 'Tiada rekod sepadan ditemui',
    'No entries found': 'Tiada rekod ditemui',
    'Loading...': 'Memuatkan...',
    'Processing...': 'Sedang diproses...',

    // Admin / Super Admin pages (admindashboard, superadmindashboard)
    'Other Services': 'Perkhidmatan Lain',
    'Archive & Records': 'Arkib & Rekod',
    'Assigned Access': 'Akses Diberikan',
    'Access Role Application': 'Permohonan Peranan Akses',
    'Attendance Data': 'Data Kehadiran',
    'Attendance Event': 'Acara Kehadiran',
    'Competency': 'Kompetensi',
    'Competency Assessment': 'Penilaian Kompetensi',
    'Housing': 'Perumahan',
    'Housing Management': 'Pengurusan Perumahan',
    'Human Resources': 'Sumber Manusia',
    'Human Resources Management': 'Pengurusan Sumber Manusia',
    'Human Resources Integrated Database System': 'Sistem Pangkalan Data Bersepadu Sumber Manusia',
    'DICT Human Resources': 'Sumber Manusia DICT',
    'Employee Movement': 'Pergerakan Pekerja',
    'Facilities': 'Kemudahan',
    'Event': 'Acara',
    'List of Events': 'Senarai Acara',
    'List of Staffs': 'Senarai Kakitangan',
    'List of Students': 'Senarai Pelajar',
    'MESH Announcement': 'Pengumuman MESH',
    'MESH Banner': 'Banner MESH',
    'MESH News': 'Berita MESH',
    'MESH Request Form': 'Borang Permohonan MESH',
    'MOE Enquiries': 'Pertanyaan MOE',
    'One Stop Centre Feedback': 'Maklum Balas Pusat Sehenti',
    'One Stop Centre Visitor': 'Pelawat Pusat Sehenti',
    'Post Establishment Management': 'Pengurusan Perjawatan',
    'Prohibited Company': 'Syarikat Ditegah',
    'Personnel ID': 'ID Personel',
    'Personnel Data Management System': 'Sistem Pengurusan Data Personel',
    'Strategic Performance Info System': 'Sistem Maklumat Prestasi Strategik',
    'Student Data': 'Data Pelajar',
    'Students & School Staff': 'Pelajar & Kakitangan Sekolah',
    'Support Requests': 'Permohonan Sokongan',
    'User Create': 'Cipta Pengguna',
    'Vacant Position': 'Jawatan Kosong',
    'Masterlist': 'Senarai Induk',
    'SSM Application': 'Permohonan SSM',
    'SSM Request Admin': 'Pentadbir Permohonan SSM',
    'Assigned of D Flow': 'D Flow Ditugaskan',
    'HRD Dashboard': 'Papan Pemuka HRD',
    'HRD List Competency': 'Senarai Kompetensi HRD',
    'Administer housing allocations for Ministry staff.': 'Urus peruntukan perumahan untuk kakitangan Kementerian.',
    'Check availability, book, and manage meeting rooms for meetings, discussions, and official activities.': 'Semak kekosongan, tempah dan urus bilik mesyuarat untuk mesyuarat, perbincangan dan aktiviti rasmi.',
    'Check availability, book, and manage syndicate rooms for small meetings of up to 4 people.': 'Semak kekosongan, tempah dan urus bilik sindiket untuk mesyuarat kecil sehingga 4 orang.',
    'Manage DICT staff biodata, training, leave, and employment records.': 'Urus biodata, latihan, cuti dan rekod perkhidmatan kakitangan DICT.',
    'Manage and Publish announcements to all MESH users.': 'Urus dan terbitkan pengumuman kepada semua pengguna MESH.',
    'Manage and Publish news articles and updates on MESH.': 'Urus dan terbitkan artikel berita dan kemas kini di MESH.',
    'Manage and issue staff identification records.': 'Urus dan keluarkan rekod pengenalan kakitangan.',
    'Manage and maintain human resources data across the Ministry of Education through an integrated platform': 'Urus dan selenggara data sumber manusia di seluruh Kementerian Pendidikan melalui platform bersepadu',
    'Manage and retrieve archived records for easy reference and access': 'Urus dan dapatkan semula rekod yang diarkibkan untuk rujukan dan akses yang mudah',
    'Manage approved staffing posts and establishment records.': 'Urus jawatan yang diluluskan dan rekod perjawatan.',
    'Manage the informational banners shown on the MESH homepage.': 'Urus banner maklumat yang dipaparkan di laman utama MESH.',
    'Manage, monitor, and coordinate technical support requests through the DevOps Support Desk.': 'Urus, pantau dan selaras permohonan sokongan teknikal melalui Meja Sokongan DevOps.',
    'Review feedback submitted through the One Stop Centre.': 'Semak maklum balas yang dihantar melalui Pusat Sehenti.',
    'Review staff performance records and appraisals.': 'Semak rekod prestasi dan penilaian kakitangan.',
    'Send a general enquiry to the Ministry of Education.': 'Hantar pertanyaan umum kepada Kementerian Pendidikan.',
    'Submit and track questions/responses anonymously for training or event purposes': 'Hantar dan jejak soalan/jawapan tanpa nama untuk tujuan latihan atau acara',
    'Submit requests for technical consultation, system development, enhancements, and other IT-related services based on departmental needs.': 'Hantar permohonan konsultasi teknikal, pembangunan sistem, penambahbaikan dan perkhidmatan IT lain mengikut keperluan jabatan.',
    'Track attendance across students and school staff.': 'Jejak kehadiran pelajar dan kakitangan sekolah.',
    'Upload and manage attendance datasets across departments.': 'Muat naik dan urus set data kehadiran merentas jabatan.',

    // MEA (moeevent)
    'Create Event': 'Cipta Acara',
    'Event Date': 'Tarikh Acara',
    'Event Date End': 'Tarikh Tamat Acara',
    'Event Time': 'Masa Acara',
    'Event Venue': 'Tempat Acara',
    'Event Details': 'Butiran Acara',
    'Approve Participant': 'Luluskan Peserta',
    'Approved Participants': 'Peserta Diluluskan',
    'List Approved Participant': 'Senarai Peserta Diluluskan',
    'Add CC Person': 'Tambah Penerima Salinan',
    'Registered List': 'Senarai Berdaftar',
    'Please scan the QR Code below': 'Sila imbas Kod QR di bawah',
    'QR Code': 'Kod QR',
    'No QR code': 'Tiada kod QR',

    // Room booking (adminbooking, bookings)
    'Room Booking': 'Tempahan Bilik',
    'Booking Room': 'Tempahan Bilik',
    'Booking Room For': 'Tempahan Bilik Untuk',
    'Booking System': 'Sistem Tempahan',
    'Booking History': 'Sejarah Tempahan',
    'History of Bookings': 'Sejarah Tempahan',
    'List of Bookings': 'Senarai Tempahan',
    'Booking Schedule': 'Jadual Tempahan',
    'Add Booking': 'Tambah Tempahan',
    'Edit Booking': 'Ubah Tempahan',
    'Show Booking': 'Lihat Tempahan',
    'Create booking': 'Cipta tempahan',
    'Create Room': 'Cipta Bilik',
    'Room Details': 'Butiran Bilik',
    'Room No.': 'No. Bilik',
    'Meeting Room': 'Bilik Mesyuarat',
    'Meeting Room Booking System': 'Sistem Tempahan Bilik Mesyuarat',
    'Select a Room': 'Pilih Bilik',
    'Please select a Room': 'Sila pilih Bilik',
    'There are no rooms available at the time you have chosen': 'Tiada bilik tersedia pada masa yang anda pilih',
    'Recurring until': 'Berulang sehingga',
    'Legend': 'Petunjuk',

    // D Flow (eminit)
    'Memo From': 'Memo Daripada',
    'Memo Status': 'Status Memo',
    'For Action': 'Untuk Tindakan',
    'For Attention': 'Untuk Perhatian',
    'Action By': 'Tindakan Oleh',
    'Action From': 'Tindakan Daripada',
    'Action To': 'Tindakan Kepada',
    'Action Status': 'Status Tindakan',
    'Action Type': 'Jenis Tindakan',
    'Action Document': 'Dokumen Tindakan',
    'Date Received': 'Tarikh Diterima',
    'Director Remarks': 'Catatan Pengarah',
    'Director Received': 'Diterima Pengarah',
    'Admin Remarks': 'Catatan Pentadbir',
    'Admin Received': 'Diterima Pentadbir',
    'Add Remark': 'Tambah Catatan',
    'No Remarks': 'Tiada Catatan',
    'Upload New Documents': 'Muat Naik Dokumen Baharu',
    'View Document': 'Lihat Dokumen',
    'Uploaded Document': 'Dokumen Dimuat Naik',
    'No documents': 'Tiada dokumen',
    'No Document Available': 'Tiada Dokumen',
    'No existing documents.': 'Tiada dokumen sedia ada.',
    'No action documents uploaded.': 'Tiada dokumen tindakan dimuat naik.',
    'No e-memo action information yet.': 'Belum ada maklumat tindakan e-memo.',
    'Memo response has been completed': 'Maklum balas memo telah selesai',

    // MNS, FSD, DRF / DSS
    'Send a Notification': 'Hantar Pemberitahuan',
    'Add Phone Number': 'Tambah Nombor Telefon',
    'No Recipient': 'Tiada Penerima',
    'Online Notification Form': 'Borang Pemberitahuan Dalam Talian',
    'Shared Folders': 'Folder Dikongsi',
    'Shared With Me': 'Dikongsi Dengan Saya',
    'User-Created Folders': 'Folder Dicipta Pengguna',
    'Folder Name': 'Nama Folder',
    'Folder Access': 'Akses Folder',
    'Enter folder name': 'Masukkan nama folder',
    'Users with Access': 'Pengguna dengan Akses',
    'No folders found': 'Tiada folder ditemui',
    'File Storage Management': 'Pengurusan Storan Fail',
    'Create New Request': 'Cipta Permohonan Baharu',
    'DevOps Request': 'Permohonan DevOps',
    'Devops Requests': 'Permohonan DevOps',
    // #============= ORI CODE ==============
    // 'DevOps Service Desk': 'Meja Perkhidmatan DevOps'
    // #================================
    'DevOps Service Desk': 'Meja Perkhidmatan DevOps',
    // #================================

    // #========== NEWLY ADDED ============
    // My SSM admin pages (ssms/indexall, ssmrequests/indexall, ssmrequests/indexpermohonan), Oct 2026
    'Position ID': 'ID Kedudukan',
    'Ref. No.': 'No. Rujukan',
    'Ref. No': 'No. Rujukan',
    // #================================

    // #========== NEWLY ADDED ============
    // Super Admin pages (My SSM, Information, MNS, Q&A, MEA, MAS, DRF, DSS, MOE Enquiries, banner, announcements,
    // news): English text on those pages, shown in Malay when BM is picked (Oct 2026)
    'Add IC No.': 'Tambah No. K/P',
    'Add IC Number': 'Tambah Nombor K/P',
    'Announcement - Edit': 'Pengumuman - Ubah',
    'Announcement Content': 'Kandungan Pengumuman',
    'Announcement-Admin': 'Pengumuman-Pentadbir',
    'At least 1 Icon are required to be checked': 'Sekurang-kurangnya 1 ikon perlu ditanda',
    'Approval': 'Kelulusan',
    'Approver IC.No': 'No. K/P Pelulus',
    'Approver Name': 'Nama Pelulus',
    'Archived Records': 'Rekod Diarkibkan',
    'Basic example': 'Contoh asas',
    'Catatan User': 'Catatan Pengguna',
    'Change Notification': 'Tukar Pemberitahuan',
    'Check to remove chosen file': 'Tanda untuk membuang fail yang dipilih',
    'Check to remove chosen IC Number': 'Tanda untuk membuang Nombor K/P yang dipilih',
    'Contact.No': 'No. Telefon',
    'Contact.No.': 'No. Telefon',
    'Create List DRF Admin Email': 'Cipta Senarai E-mel Pentadbir DRF',
    'Created_at': 'Dicipta Pada',
    'Updated_at': 'Dikemas Kini Pada',
    'Ic_no': 'No. K/P',
    'Current Files': 'Fail Semasa',
    'Day/s': 'Hari',
    'Days/s': 'Hari',
    'Delete Cuti': 'Padam Cuti',
    'Despatch': 'Penghantaran',
    'DevOps Service': 'Perkhidmatan DevOps',
    'Documents Posted': 'Dokumen Diterbitkan',
    'Does not require to be checked when replacing the current image': 'Tidak perlu ditanda jika menggantikan imej semasa',
    'Edit Announcement': 'Ubah Pengumuman',
    'Edit Jabatan': 'Ubah Jabatan',
    'Edit Perkara': 'Ubah Perkara',
    'Edit Senarai Jabatan': 'Ubah Senarai Jabatan',
    'True': 'Ya',
    'False': 'Tidak',
    'File No': 'No. Fail',
    'IC.No': 'No. K/P',
    'Image': 'Imej',
    'List DRF Email': 'Senarai E-mel DRF',
    'Manage Admin Emails': 'Urus E-mel Pentadbir',
    'Master Search': 'Carian Induk',
    'MOE Event': 'Acara MOE',
    'Necessary Icons': 'Ikon Diperlukan',
    'New IC No.': 'No. K/P Baharu',
    'New Update/Feature': 'Kemas Kini/Ciri Baharu',
    'News': 'Berita',
    'News-Admin': 'Berita-Pentadbir',
    'No file': 'Tiada fail',
    'No IC Numbers available.': 'Tiada Nombor K/P tersedia.',
    'No image chosen': 'Tiada imej dipilih',
    'No Perkara have been shared with you': 'Tiada Perkara dikongsi dengan anda',
    'Notification': 'Pemberitahuan',
    'Old IC No.': 'No. K/P Lama',
    'Optional File Size up to 2MB': 'Pilihan: saiz fail sehingga 2MB',
    'Optional Image Size up to 2MB': 'Pilihan: saiz imej sehingga 2MB',
    'Others': 'Lain-lain',
    'Page': 'Halaman',
    'of': 'daripada',
    'Password': 'Kata Laluan',
    'Password OTP': 'OTP Kata Laluan',
    'Perkara Details': 'Butiran Perkara',
    'Picture': 'Gambar',
    'Read': 'Dibaca',
    'Remove file': 'Buang fail',
    'Remove IC Number': 'Buang Nombor K/P',
    'Remove image': 'Buang imej',
    'Replied': 'Dibalas',
    'Reset Password': 'Set Semula Kata Laluan',
    'Review Message': 'Semak Mesej',
    'Review Soalan': 'Semak Soalan',
    'Search by Name / IC Number (Eg. 00123456)': 'Cari mengikut Nama / Nombor K/P (Contoh: 00123456)',
    'Show Soalan': 'Papar Soalan',
    'SSM Request Permohonan': 'Permohonan SSM',
    'Status (Approve? / Reject?)': 'Status (Lulus? / Tolak?)',
    'Status Admin': 'Status Pentadbir',
    'Submitted At': 'Dihantar Pada',
    'There are Currently No Announcement!': 'Tiada Pengumuman Buat Masa Ini!',
    'There are Currently No News!': 'Tiada Berita Buat Masa Ini!',
    'This information send to EASE': 'Maklumat ini dihantar ke EASE',
    'View current files': 'Lihat fail semasa',
    'View current image': 'Lihat imej semasa',
    'Tarikh Cuti (Delete)': 'Tarikh Cuti (Padam)',
    'Baki Cuti Admin': 'Baki Cuti Pentadbir',
    'Kiv Catatan': 'Catatan KIV',
    'Pecahan Female vs Male': 'Pecahan Perempuan vs Lelaki',
    'Pertukaran IC No': 'Pertukaran No. K/P',
    'Pertukaran IC': 'Pertukaran K/P',
    // #================================

    // #========== NEWLY ADDED ============
    // Example hints on the DRF, MAS slip and role request forms: "Contoh" in BM (Oct 2026)
    'Eg. 8888888': 'Contoh: 8888888',
    'Example : 00123456': 'Contoh: 00123456',
    'example@moe.gov.bn': 'contoh@moe.gov.bn'
    // #================================
  };
  Object.keys(MORE).forEach(function (k) {
    if (!Object.prototype.hasOwnProperty.call(MS, k)) { MS[k] = MORE[k]; }
  });

  // Same list keyed in lower case, so "SUBMIT", "submit" and "Devops Request Form" still match
  var MS_LC = {};
  Object.keys(MS).forEach(function (k) { MS_LC[k.toLowerCase()] = MS[k]; });
  // #================================

  // #========== NEWLY ADDED ============
  // Malay -> English (Oct 2026). Many MESH pages are written in Malay, so EN now also translates their Malay text
  // into English (BM leaves Malay text as it is). Started with the MNS form (onlinenotification/indexuser), the MAS
  // slip (slipkedatangan-new), LinkUP (linkup/index) and the Malay labels used most across the views.
  // To add more: 'Teks Melayu': 'English text',
  var EN = {
    // Common labels and buttons
    'Laman Utama': 'Home',
    'Nama': 'Name',
    'Nama Penuh': 'Full Name',
    'Nama penuh': 'Full name',
    'Jabatan': 'Department',
    'Bahagian': 'Division',
    'Bahagian/Unit': 'Division/Unit',
    'Jawatan': 'Position',
    'No. Kad Pengenalan': 'IC No.',
    'No Kad Pengenalan': 'IC No.',
    'No. KP': 'IC No.',
    'Tarikh': 'Date',
    'Masa': 'Time',
    'Tarikh Mula': 'Start Date',
    'Tarikh Tamat': 'End Date',
    'Tarikh Lahir': 'Date of Birth',
    'Tempat Lahir': 'Place of Birth',
    'Tarikh Bersara': 'Retirement Date',
    'Tempat Bertugas': 'Place of Work',
    'Jantina': 'Gender',
    'Lelaki': 'Male',
    'Perempuan': 'Female',
    'Bangsa': 'Race',
    'Agama': 'Religion',
    'Alamat': 'Address',
    'Daerah': 'District',
    'Sekolah': 'School',
    'Nama Sekolah': 'School Name',
    'Kementerian': 'Ministry',
    'Kementerian Pendidikan': 'Ministry of Education',
    'Tahun': 'Year',
    'Hari': 'Day',
    'Kategori': 'Category',
    'Jenis': 'Type',
    'Tajuk': 'Title',
    'Perkara': 'Subject',
    'Catatan': 'Remarks',
    'Ulasan': 'Comments',
    'Keterangan': 'Description',
    'Dokumen': 'Document',
    'Fail': 'File',
    'Nama Fail': 'File Name',
    'Emel': 'Email',
    'No. Telefon': 'Phone No.',
    'No Telefon': 'Phone No.',
    'Nombor telefon': 'Phone number',
    'Nombor Telefon': 'Phone Number',
    'Peranan': 'Role',
    'Pengguna': 'User',
    'Daripada': 'From',
    'Kepada': 'To',
    'Untuk Tindakan': 'For Action',
    'Untuk Perhatian': 'For Attention',
    'Tindakan': 'Action',
    'Status Permohonan': 'Application Status',
    'Dicipta Pada': 'Created At',
    'Bil.': 'No.',
    'Hantar': 'Submit',
    'Simpan': 'Save',
    'Batal': 'Cancel',
    'Padam': 'Delete',
    'Kemaskini': 'Update',
    'Kemas Kini': 'Update',
    'Kembali': 'Back',
    'Tutup': 'Close',
    'Cari': 'Search',
    'Tapis': 'Filter',
    'Lihat': 'View',
    'Tambah': 'Add',
    'Salin': 'Copy',
    'Salin Pautan': 'Copy Link',
    'Pautan Disalin!': 'Link Copied!',
    'Muat Naik Dokumen': 'Upload Document',
    'Muat Naik Fail': 'Upload File',
    'Selesai': 'Done',
    'Menunggu': 'Pending',
    'Diterima': 'Received',
    'Diluluskan': 'Approved',
    'Ditolak': 'Rejected',
    'Pilih Jabatan': 'Select Department',
    'Pilih Jawatan': 'Select Position',
    'Pilih Status': 'Select Status',
    'Pilih Peranan': 'Select Role',
    'Pilih Perkara': 'Select Subject',
    'Pilih Perkhidmatan': 'Select Service',
    'Sahkan Pemadaman': 'Confirm Deletion',
    'Adakah anda pasti mahu memadam rekod ini?': 'Are you sure you want to delete this record?',
    'Tiada rekod dijumpai': 'No records found',
    'Tiada rekod ditemui': 'No records found',
    'Tiada rekod': 'No records',
    'Tiada fail': 'No file',
    'Tiada Lampiran': 'No Attachment',
    'Hanya fail sehingga 10MB saiz diterima': 'Only files up to 10MB are accepted',

    // MNS form (onlinenotification/indexuser)
    'MESH Perkhidmatan Notifikasi': 'MESH Notification Service',
    'Mesh Perkhidmatan Notifikasi': 'MESH Notification Service',
    'Maklumat M.P.N': 'M.P.N Details',
    'Maklumat O.N.S': 'O.N.S Details',
    'No Penerima': 'Recipient No.',
    'No IC Penghantar': "Sender's IC No.",
    'Tambah Nombor Telefon': 'Add Phone Number',
    // #========== NEWLY ADDED ============
    'Buang': 'Remove',
    // #================================
    'Teks': 'Text',
    'Perenggan 1': 'Paragraph 1',
    'Perenggan 2': 'Paragraph 2',

    // MAS slip (slipkedatangan-new)
    'Slip Kehadiran': 'Attendance Slip',
    'Slip Kedatangan': 'Attendance Slip',
    'Kementerian Lain (others)': 'Other Ministry',
    'Pengerusi': 'Chairperson',
    'Ahli': 'Member',
    'Setiausaha': 'Secretary',
    'Urusetia': 'Secretariat',
    'Ketua Jabatan': 'Head of Department',
    'Wakil Jabatan': 'Department Representative',
    'Hadir': 'Present',

    // LinkUP (linkup/index)
    'Mesh Kongsi Pautan': 'MESH Link Sharing',
    'Kod Qr': 'QR Code',
    // #============= ORI CODE ==============
    // 'Kod QR': 'QR Code'
    // #================================
    'Kod QR': 'QR Code',
    // #================================

    // #========== NEWLY ADDED ============
    // DSD form (support_center/create-new), DRF form (devopsrequest/drf-create-new) and the role request form
    // (permohonanrole), wording agreed in the previews, Oct 2026
    'Huraian': 'Description',
    'Huraian masalah / permintaan': 'Description of the problem / request',
    'Huraian projek': 'Project description',
    'Kepentingan': 'Priority',
    'Pilih Keutamaan': 'Select Priority',
    'Tambah Fail': 'Add File',
    '+ Tambah Fail': '+ Add File',
    'Boleh muat naik lebih dari satu fail (maks 10MB setiap satu)': 'You can upload more than one file (max 10MB each)',
    'Pengesahan': 'Verification',
    'Sila pilih nombor': 'Please choose the number',
    'Sila lengkapkan borang ini untuk menghantar aduan atau permohonan bantuan kepada pihak DevOps.': 'Please complete this form to send a complaint or a request for help to the DevOps team.',
    'Bahagian DevOps': 'DevOps Division',
    'Jejantas penghubung tingkat 1, Block B/C': 'Connecting bridge, level 1, Block B/C',
    'Contoh: Masalah login sistem': 'Example: System login problem',
    'Nama Projek': "Project's name",
    'Perkhidmatan': 'Service',
    'Tarikh Diperlukan': 'Date needed',
    'Penyelaras Projek': 'Project coordinator',
    'Nama Penyelaras Projek': "Project coordinator's name",
    // #========== NEWLY ADDED ============
    // My SSM admin pages (ssmrequests/indexpermohonan), Oct 2026
    'Jabatan/Sekolah': 'Department/School',
    'Jenis Permohonan': 'Types of Applications',
    'Tarikh Permohonan': 'Application Date',
    'IC No. Pemohon': "Applicant's IC No.",
    'ICNo. Pemohon': "Applicant's IC No.",
    'No. K/P': 'IC No.',
    // #================================
    // #========== NEWLY ADDED ============
    // Super Admin pages: Malay text on those pages (and mixed Malay/English labels), shown in English when EN
    // is picked (Oct 2026)
    'Aduan': 'Complaint',
    'Aduan Diterima': 'Complaint Received',
    'Baki Cuti': 'Leave Balance',
    'Baki Cuti Admin': 'Leave Balance Admin',
    'Bersara': 'Retirement',
    'Cuti': 'Leave',
    'Memangku': 'Acting',
    'Butiran Permohonan Sokongan': 'Support Request Details',
    'Catatan Admin': 'Admin Remarks',
    'Catatan User': 'User Remarks',
    'Dalam Proses': 'In Progress',
    'Proses': 'Processing',
    'Delete Cuti': 'Delete Leave',
    'Di Buat Oleh': 'Created By',
    'Di Buat Pada': 'Created At',
    'Di Kemaskini Pada': 'Updated At',
    'Dihadapkan ke Dynamik': 'Submitted to Dynamik',
    'Dihadapkan ke HD': 'Submitted to HD',
    'Edit Jabatan': 'Edit Department',
    'Edit Perkara': 'Edit Subject',
    'Edit Senarai Jabatan': 'Edit Department List',
    'Gambar Passport': 'Passport Photo',
    'ID Tiket': 'Ticket ID',
    'Jawatan Bersara': 'Retirement Position',
    'Jawatan yang dipangku': 'Acting Position',
    'Jenis Cuti': 'Type of Leave',
    'Jumlah Kehadiran': 'Total Attendance',
    'Keterangan Slip Kehadiran': 'Attendance Slip Description',
    'Kiv Catatan': 'KIV Remarks',
    'Kod': 'Code',
    'Lampiran': 'Attachment',
    'Langganan': 'Subscription',
    'Langganan (EASE)': 'Subscription (EASE)',
    'Masukkan Paparan Iklan': 'Add Banner Advertisement',
    'Mesh Paparan Iklan': 'MESH Banner Advertisement',
    'Mesej Hantaran': 'Sent Message',
    'Mesej': 'Message',
    'MESH - Pemberitahuan': 'MESH - Notifications',
    'No IC Pengirim': "Sender's IC No.",
    'No Perkara have been shared with you': 'No subjects have been shared with you',
    'No.Tel': 'Phone No.',
    'Pecahan Female vs Male': 'Female vs Male Breakdown',
    'Pecahan Hadir / Tidak Hadir': 'Present / Absent Breakdown',
    'Pecahan Permohonan': 'Application Breakdown',
    'Pemberitahuan': 'Notifications',
    'Penting': 'Important',
    'Penamatan': 'Termination',
    'Perkara Baru': 'New Subject',
    'Perkara Details': 'Subject Details',
    'Perkhidmatan Bantuan DevOps': 'DevOps Support Service',
    'Perkhidmatan Sesi Soal Jawab': 'Q&A Session Service',
    'Permohonan': 'Applications',
    'Permohonan dipadam & Selesai': 'Application deleted & completed',
    'Permohonan Diterima': 'Application Received',
    'Pertukaran IC': 'IC Change',
    'Pertukaran IC No': 'IC No. Change',
    'Peruntukan Bersara': 'Retirement Allocation',
    'Review Soalan': 'Review Question',
    'Salinan Kad Pengenalan': 'Copy of IC',
    'Search by Name / IC Number (Eg. 00123456)': 'Search by Name / IC Number (Example: 00123456)',
    'Sebab Memangku': 'Reason for Acting',
    'Sedang Dikemaskini / Diteliti': 'Being Updated / Reviewed',
    'Senarai': 'List',
    'Senarai Emel': 'Email List',
    'Show Soalan': 'Show Question',
    'Soalan': 'Question',
    'SSM Request Permohonan': 'SSM Application Requests',
    'Status Admin': 'Admin Status',
    'Surat Lantikan': 'Appointment Letter',
    'Surat Melapor Diri': 'Reporting Letter',
    'Tambah Catatan': 'Add Remark',
    'Tambah Emel': 'Add Email',
    'Tanggagaji yang dipangku': 'Acting Salary Scale',
    'Tarikh & Masa': 'Date & Time',
    'Tarikh Aduan': 'Complaint Date',
    'Tarikh Akhir Cuti': 'Leave End Date',
    'Tarikh Akhir Memangku': 'Acting End Date',
    'Tarikh Baki Cuti': 'Leave Balance Date',
    'Tarikh Berakhir': 'End Date',
    'Tarikh Berakhir Cuti Bersara': 'Retirement Leave End Date',
    'Tarikh Bermula': 'Start Date',
    'Tarikh Cuti (Delete)': 'Leave Date (Delete)',
    'Tarikh Mula Cuti': 'Leave Start Date',
    'Tarikh Mula Cuti Bersara': 'Retirement Leave Start Date',
    'Tarikh Mula Memangku': 'Acting Start Date',
    'Tarikh Penamatan': 'Termination Date',
    'Tempoh Cuti': 'Leave Duration',
    'Tempoh Memangku': 'Acting Duration',
    'Utama': 'Home',
    'Sila gunakan imej dengan spesifikasi 1280 x 300': 'Please use an image sized 1280 x 300',
    // #================================    // English hints written on the forms, shown as "Example" in EN
    'Eg. 8888888': 'Example: 8888888',
    'Example : 00123456': 'Example: 00123456'
    // #================================
  };
  var EN_LC = {};
  Object.keys(EN).forEach(function (k) { EN_LC[k.toLowerCase()] = EN[k]; });

  // Malay text that carries a number
  var EN_PATTERNS = [
    // #============= ORI CODE ==============
    // [/^(\d+) \/ (\d+) aksara$/, function (m) { return m[1] + ' / ' + m[2] + ' characters'; }],
    // #================================
    // The MNS counter now says "huruf" (was "aksara"); both are matched
    [/^(\d+) \/ (\d+) (aksara|huruf)$/, function (m) { return m[1] + ' / ' + m[2] + ' characters'; }],
    // #================================
    [/^---\s*Pilih (.+?)\s*---$/, function (m) { var t = lookupIn(EN, EN_LC, 'Pilih ' + m[1]); return t ? '---' + t + '---' : null; }]
  ];

  // Generic exact / any-case lookup used for the Malay -> English list
  function lookupIn(map, lcMap, s) {
    if (Object.prototype.hasOwnProperty.call(map, s)) { return map[s]; }
    var lc = s.toLowerCase();
    if (Object.prototype.hasOwnProperty.call(lcMap, lc)) {
      return (s === s.toUpperCase() && s !== lc) ? lcMap[lc].toUpperCase() : lcMap[lc];
    }
    return null;
  }

  // Malay -> English, with the same "label:" / "label *" / "-- label --" handling as tr()
  function trEn(s) {
    var t = lookupIn(EN, EN_LC, s);
    if (t !== null) { return t; }
    for (var i = 0; i < EN_PATTERNS.length; i++) {
      var m = s.match(EN_PATTERNS[i][0]);
      if (m) { var r = EN_PATTERNS[i][1](m); if (r) { return r; } }
    }
    var a = s.match(/^([\s\-–—*]*)(.*?)([\s:*\-–—]*)$/);
    if (a && a[2] && (a[1] || a[3])) {
      t = lookupIn(EN, EN_LC, a[2]);
      if (t !== null) { return a[1] + t + a[3]; }
    }
    return s;
  }
  // #================================

  var DAYS = { Monday: 'Isnin', Tuesday: 'Selasa', Wednesday: 'Rabu', Thursday: 'Khamis', Friday: 'Jumaat', Saturday: 'Sabtu', Sunday: 'Ahad' };
  var MONTHS = { January: 'Januari', February: 'Februari', March: 'Mac', April: 'April', May: 'Mei', June: 'Jun', July: 'Julai', August: 'Ogos', September: 'September', October: 'Oktober', November: 'November', December: 'Disember' };
  function msDate(s) { return s.replace(/[A-Z][a-z]+/g, function (w) { return DAYS[w] || MONTHS[w] || w; }); }

  // Text that carries a number or a date
  var PATTERNS = [
    [/^(\d+) new$/, function (m) { return m[1] + ' baharu'; }],
    [/^Announcements, (\d+) new$/, function (m) { return 'Pengumuman, ' + m[1] + ' baharu'; }],
    [/^(\d+) to act$/, function (m) { return m[1] + ' perlu tindakan'; }],
    // greeting date line, e.g. "Monday, 5 October 2026"
    [/^(Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday),? \d{1,2} [A-Z][a-z]+ \d{4}$/, function (m) { return msDate(m[0]); }]
  ];

  // #========== NEWLY ADDED ============
  // Table counters (DataTables, simple-datatables, Laravel pagination) and "Page x of y"
  PATTERNS.push(
    [/^Showing (\d[\d,]*) to (\d[\d,]*) of (\d[\d,]*) (entries|results|records)$/, function (m) { return 'Memaparkan ' + m[1] + ' hingga ' + m[2] + ' daripada ' + m[3] + ' rekod'; }],
    [/^\(filtered from (\d[\d,]*) total entries\)$/, function (m) { return '(ditapis daripada ' + m[1] + ' rekod)'; }],
    [/^Page (\d+) of (\d+)$/, function (m) { return 'Halaman ' + m[1] + ' daripada ' + m[2]; }]
  );
  // #========== NEWLY ADDED ============
  // Leave / acting lengths written as "3 Days/s" or "3 Day/s" (cutis, actings, bersaras): "3 Hari" in BM (Oct 2026)
  PATTERNS.push(
    [/^(\d+(?:\.\d+)?) Days?\/s$/i, function (m) { return m[1] + ' Hari'; }]
  );
  // #================================

  // Exact match first, then the same text in any letter case (all-caps text stays all-caps)
  function lookup(s) {
    if (Object.prototype.hasOwnProperty.call(MS, s)) { return MS[s]; }
    var lc = s.toLowerCase();
    if (Object.prototype.hasOwnProperty.call(MS_LC, lc)) {
      return (s === s.toUpperCase() && s !== lc) ? MS_LC[lc].toUpperCase() : MS_LC[lc];
    }
    return null;
  }
  // #================================

  // #============= ORI CODE ==============
  // function tr(s) {
  //   if (Object.prototype.hasOwnProperty.call(MS, s)) { return MS[s]; }
  //   for (var i = 0; i < PATTERNS.length; i++) {
  //     var m = s.match(PATTERNS[i][0]);
  //     if (m) { return PATTERNS[i][1](m); }
  //   }
  //   return s;
  // }
  // #================================
  function tr(s) {
    var t = lookup(s);
    if (t !== null) { return t; }
    for (var i = 0; i < PATTERNS.length; i++) {
      var m = s.match(PATTERNS[i][0]);
      if (m) { return PATTERNS[i][1](m); }
    }
    // Labels wrapped in punctuation: "Remarks:", "Date of Birth *", "-- Select Category --"
    var a = s.match(/^([\s\-–—*]*)(.*?)([\s:*\-–—]*)$/);
    if (a && a[2] && (a[1] || a[3])) {
      t = lookup(a[2]);
      if (t !== null) { return a[1] + t + a[3]; }
    }
    return s;
  }
  // #================================

  var ATTRS = ['placeholder', 'aria-label', 'title'];
  var textRec = new WeakMap();   // text node -> { en, ms }
  var attrRec = new WeakMap();   // element   -> { attr: { en, ms } }
  var lang = 'en';

  // Never touch scripts, styles or anything the user types into (editors, text boxes)
  function skip(el) {
    return !el || el.closest('script, style, textarea, [contenteditable], .ck-editor, .ql-editor, .tox, .mesh-lang-toggle button');
  }

  // #============= ORI CODE ==============
  // function doText(node) {
  //   if (skip(node.parentElement)) { return; }
  //   var raw = node.data, rec = textRec.get(node);
  //   if (lang === 'ms') {
  //     if (rec && raw === rec.ms) { return; }
  //     var key = raw.replace(/\s+/g, ' ').trim();
  //     if (!key) { return; }
  //     var t = tr(key);
  //     if (t === key) { return; }
  //     var ms = raw.match(/^\s*/)[0] + t + raw.match(/\s*$/)[0];
  //     textRec.set(node, { en: raw, ms: ms });
  //     node.data = ms;
  //   } else if (rec) {
  //     if (raw === rec.ms) { node.data = rec.en; }
  //     textRec.delete(node);
  //   }
  // }
  //
  // function doAttr(el, name) {
  //   if (skip(el) || !el.hasAttribute(name)) { return; }
  //   var val = el.getAttribute(name), all = attrRec.get(el) || {}, rec = all[name];
  //   if (lang === 'ms') {
  //     if (rec && val === rec.ms) { return; }
  //     var t = tr(val.trim());
  //     if (t === val.trim()) { return; }
  //     all[name] = { en: val, ms: t };
  //     attrRec.set(el, all);
  //     el.setAttribute(name, t);
  //   } else if (rec) {
  //     if (val === rec.ms) { el.setAttribute(name, rec.en); }
  //     delete all[name];
  //   }
  // }
  // #================================
  // Both directions now: BM translates English text with MS, EN translates Malay text with EN.
  // Each record keeps the page's own text (orig) and what is on screen (shown), so switching always starts
  // from the page's own wording, and text the page itself changes later is picked up as the new original.
  function trTo(s) { return lang === 'ms' ? tr(s) : trEn(s); }

  function doText(node) {
    if (skip(node.parentElement)) { return; }
    var raw = node.data, rec = textRec.get(node);
    var base = (rec && raw === rec.shown) ? rec.orig : raw;
    var key = base.replace(/\s+/g, ' ').trim();
    var t = key ? trTo(key) : key;
    if (!key || t === key) {
      if (rec) { if (raw === rec.shown) { node.data = rec.orig; } textRec.delete(node); }
      return;
    }
    var out = base.match(/^\s*/)[0] + t + base.match(/\s*$/)[0];
    textRec.set(node, { orig: base, shown: out });
    if (raw !== out) { node.data = out; }
  }

  function doAttr(el, name) {
    // #============= ORI CODE ==============
    // if (skip(el) || !el.hasAttribute(name)) { return; }
    // #================================
    // A text box's own placeholder hint ("Perenggan 1") is translated; what people type in it never is
    if (!el || !el.hasAttribute(name)) { return; }
    if (name === 'placeholder' && /^(TEXTAREA|INPUT)$/.test(el.tagName) ? skip(el.parentElement) : skip(el)) { return; }
    // #================================
    var val = el.getAttribute(name), all = attrRec.get(el) || {}, rec = all[name];
    var base = (rec && val === rec.shown) ? rec.orig : val;
    var key = base.trim();
    var t = key ? trTo(key) : key;
    if (!key || t === key) {
      if (rec) { if (val === rec.shown) { el.setAttribute(name, rec.orig); } delete all[name]; }
      return;
    }
    all[name] = { orig: base, shown: t };
    attrRec.set(el, all);
    if (val !== t) { el.setAttribute(name, t); }
  }
  // #================================

  function walk(root) {
    if (root.nodeType === 3) { doText(root); return; }
    if (root.nodeType !== 1) { return; }
    ATTRS.forEach(function (a) { doAttr(root, a); });
    var w = document.createTreeWalker(root, NodeFilter.SHOW_ELEMENT | NodeFilter.SHOW_TEXT), n;
    while ((n = w.nextNode())) {
      if (n.nodeType === 3) { doText(n); } else { ATTRS.forEach(function (a) { doAttr(n, a); }); }
    }
  }

  // Catch text the page adds or changes later (popups, bell count, dark mode button label). Idle in EN.
  new MutationObserver(function (muts) {
    // #============= ORI CODE ==============
    // if (lang !== 'ms') { return; }
    // #================================
    // Runs in EN too now, since EN also translates (Malay text into English)
    // #================================
    muts.forEach(function (m) {
      if (m.type === 'characterData') { doText(m.target); }
      else if (m.type === 'attributes') { doAttr(m.target, m.attributeName); }
      else { m.addedNodes.forEach(walk); }
    });
  }).observe(document.body, { subtree: true, childList: true, characterData: true, attributes: true, attributeFilter: ATTRS });

  var btns = document.querySelectorAll('.mesh-lang-toggle [data-mesh-lang]');

  function setLang(next) {
    lang = next === 'ms' ? 'ms' : 'en';
    document.documentElement.setAttribute('lang', lang);
    Array.prototype.forEach.call(btns, function (b) {
      b.setAttribute('aria-pressed', String(b.getAttribute('data-mesh-lang') === lang));
    });
    walk(document.body);
    try { if (window.localStorage) { localStorage.setItem('mesh-lang', lang); } } catch (e) { /* ignore */ }
    document.documentElement.classList.remove('mesh-lang-pending');
  }

  Array.prototype.forEach.call(btns, function (b) {
    b.addEventListener('click', function () { setLang(b.getAttribute('data-mesh-lang')); });
  });

  var saved = 'en';
  try { saved = window.localStorage && localStorage.getItem('mesh-lang') === 'ms' ? 'ms' : 'en'; } catch (e) { /* ignore */ }
  setLang(saved);
})();
// #================================
