<?php

/*
|--------------------------------------------------------------------------
| MESH Smart Bot — knowledge base
|--------------------------------------------------------------------------
|
| Everything the assistant knows. To teach it something new, add an entry
| here — no code change needed. Run `php artisan cache:clear` afterwards.
|
| Each entry:
|   id       Unique slug.
|   title    ['en' => ..., 'ms' => ...] — shown as the answer heading.
|   keywords Words and phrases that should match this entry, in BOTH
|            languages. Include Malay terms, abbreviations, and common
|            misspellings. More is better — this is the only way users find
|            the entry, and the list is shared across languages so a Malay
|            question can reach an entry through its English keywords too.
|   roles    Roles that grant access. Omit or leave empty if open to all.
|            The bot checks these against the signed-in user's real roles.
|   url      Where to go. Relative path or a route() name.
|   answer   ['en' => ..., 'ms' => ...] — the reply. Supports **bold**,
|            *italic*, `code`, "- " bullets, "1. " numbers and "---" rules.
|
| If 'ms' is missing from a title or answer the bot falls back to 'en', so a
| half-translated entry still works.
|
| #============= ORI CODE ==============
| Many services show different things by role (Oct 2026): staff open the
| service from its card on the Home page; administrators of that service
| also get an admin view from the **Admin** (or **Super Admin**) page in the
| side menu. Where that applies, the answer describes both views, and
| 'roles' is only set when the staff page itself is restricted.
| #================================
| Many services show different things by role (Oct 2026): staff open the
| service from its card on the Home page; administrators also get an admin
| view from the **Admin** (or **Super Admin**) page. Each user only sees
| their own view:
|   answer   What a normal user sees -- what it is, then where to open it.
|            Never mention other roles here.
|   admin    Optional ['roles' => [...], 'url' => ..., 'answer' => [...]].
|            Users holding one of these roles get this answer and link
|            INSTEAD (SmartBotResponder::render). 'url' may be left out to
|            keep the normal link.
| 'roles' is only set when the staff page itself is restricted.
| #================================
|
*/

return [

    'services' => [

        /* ---------------------------------------------------------------
         | Communication and documents
         * --------------------------------------------------------------- */

        [
            'id'       => 'dflow-create',
            'title'    => [
                'en' => 'Create D Flow (eMemo)',
                'ms' => 'Create D Flow (eMemo)',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                'create d flow', 'create dflow', 'new memo', 'raise memo', 'write memo',
                'send a memo', 'send memo', 'ememo', 'e-memo', 'buat memo', 'hantar memo',
                'memo baru', 'd flow', 'dflow', 'memo',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_CREATE_EMEMO'],
            // 'url'      => '/servicesdashboard',
            // #================================
            // Home shows Create D Flow to ROLE_CREATE_EMEMO, D Flow admins and super admins; link goes straight to the page
            'roles'    => ['ROLE_CREATE_EMEMO', 'ROLE_EMINITADMIN', 'ROLE_SUPERADMIN'],
            'url'      => 'eminit.eminit.indexeminit',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "Open **Services Dashboard** and choose **Create D Flow**.\n\nFill in the recipients, the *Tindakan Diperlukan* (action required) list, and attach any files before submitting. Once submitted, the memo sits with the first person on the action list until they act on it.",
                // 'ms' => "Buka **Papan Pemuka Perkhidmatan** dan pilih **Create D Flow**.\n\nIsikan penerima, senarai *Tindakan Diperlukan*, dan lampirkan fail sebelum menghantar. Setelah dihantar, memo itu akan berada dengan orang pertama dalam senarai tindakan sehingga beliau mengambil tindakan.",
                // #================================
                'en' => "On the **Home** page, open the **D Flow** card (under *Operations*) and choose **Create D Flow**.\n\nFill in the recipients, the *Tindakan Diperlukan* (action required) list, and attach any files before submitting. Once submitted, the memo sits with the first person on the action list until they act on it.",
                'ms' => "Di halaman **Laman Utama**, buka kad **D Flow** (di bawah *Operasi*) dan pilih **Create D Flow**.\n\nIsikan penerima, senarai *Tindakan Diperlukan*, dan lampirkan fail sebelum menghantar. Setelah dihantar, memo itu akan berada dengan orang pertama dalam senarai tindakan sehingga beliau mengambil tindakan.",
                // #================================
            ],
        ],
        [
            'id'       => 'dflow-list',
            'title'    => [
                'en' => 'List of D Flow — memos you created',
                'ms' => 'List of D Flow — memo yang anda hantar',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                'list of d flow', 'my memos', 'my memo', 'memo i sent', 'sent memos',
                'memo status', 'track memo', 'where is my memo', 'memo stuck',
                'memo is stuck', 'senarai memo', 'status memo', 'memo saya',
                'memo tersekat', 'jejak memo',
            ],
            'url'      => 'eminit.eminit.indexeminit',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**List of D Flow** shows every memo you raised, with its current status.\n\nIf a memo looks stuck, open it and check the *Tindakan Diperlukan* list — it stays with whoever is named there until they act. Chase that person directly.",
                // 'ms' => "**List of D Flow** memaparkan setiap memo yang anda hantar, berserta statusnya.\n\nJika sesuatu memo kelihatan tersekat, buka memo itu dan semak senarai *Tindakan Diperlukan* — memo akan kekal dengan orang yang dinamakan di situ sehingga beliau mengambil tindakan. Hubungi orang tersebut secara terus.",
                // #================================
                // Staff reach their own memos through Create D Flow (eminit.eminit.indexeminit); "List of D Flow" in the
                // D Flow popup is the admin list of every memo (eminit.eminit.indexeminitadmin)
                // #============= ORI CODE ==============
                // 'en' => "Your own memos, with their current status, are on the **Create D Flow** page (Home page → **D Flow** card → **Create D Flow**).\n\n**D Flow administrators** also see **List of D Flow** in the same popup — that one lists every memo in the system.\n\nIf a memo looks stuck, open it and check the *Tindakan Diperlukan* list — it stays with whoever is named there until they act. Chase that person directly.",
                // 'ms' => "Memo anda sendiri, berserta statusnya, ada di halaman **Create D Flow** (Laman Utama → kad **D Flow** → **Create D Flow**).\n\n**Pentadbir D Flow** juga melihat **List of D Flow** dalam tetingkap yang sama — senarai itu memaparkan setiap memo dalam sistem.\n\nJika sesuatu memo kelihatan tersekat, buka memo itu dan semak senarai *Tindakan Diperlukan* — memo akan kekal dengan orang yang dinamakan di situ sehingga beliau mengambil tindakan. Hubungi orang tersebut secara terus.",
                // #================================
                'en' => "Your own memos, with their current status, are on the **Create D Flow** page. Open the **D Flow** card on the Home page and choose **Create D Flow**.\n\nIf a memo looks stuck, open it and check the *Tindakan Diperlukan* list — it stays with whoever is named there until they act. Chase that person directly.",
                'ms' => "Memo anda sendiri, berserta statusnya, ada di halaman **Create D Flow**. Buka kad **D Flow** di Laman Utama dan pilih **Create D Flow**.\n\nJika sesuatu memo kelihatan tersekat, buka memo itu dan semak senarai *Tindakan Diperlukan* — memo akan kekal dengan orang yang dinamakan di situ sehingga beliau mengambil tindakan. Hubungi orang tersebut secara terus.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // D Flow admins see "List of D Flow" (every memo) in the D Flow popup
            'admin'    => [
                'roles'  => ['ROLE_EMINITADMIN', 'ROLE_SUPERADMIN'],
                'url'    => 'eminit.eminit.indexeminitadmin',
                'answer' => [
                    'en' => "**List of D Flow** lists every memo in the system, with its current status. Open the **D Flow** card (on the Home page or the **Admin** / **Super Admin** page) and choose **List of D Flow**.\n\nIf a memo looks stuck, open it and check the *Tindakan Diperlukan* list — it stays with whoever is named there until they act.",
                    'ms' => "**List of D Flow** menyenaraikan setiap memo dalam sistem, berserta statusnya. Buka kad **D Flow** (di Laman Utama atau halaman **Admin** / **Super Admin**) dan pilih **List of D Flow**.\n\nJika sesuatu memo kelihatan tersekat, buka memo itu dan semak senarai *Tindakan Diperlukan* — memo akan kekal dengan orang yang dinamakan di situ sehingga beliau mengambil tindakan.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'dflow-action',
            'title'    => [
                'en' => 'D Flow Action — memos waiting for you',
                'ms' => 'D Flow Action — memo yang menunggu tindakan anda',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                'd flow action', 'dflow action', 'memo action', 'memo waiting', 'action required',
                'my action', 'pending memo', 'approve memo', 'tindakan', 'tindakan diperlukan',
                'memo tindakan', 'memo menunggu', 'luluskan memo',
                // #========== NEWLY ADDED ============
                'to act', 'perlu tindakan', 'memo count', 'bilangan memo',
                // #================================
            ],
            'url'      => 'eminit.eminit.indexeminitaction',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**D Flow Action** lists the memos waiting on you.\n\nOpen one, record your action, and it moves on to the next person. The counter on your Services Dashboard shows how many are outstanding.",
                // 'ms' => "**D Flow Action** menyenaraikan memo yang menunggu tindakan anda.\n\nBuka satu memo, rekodkan tindakan anda, dan memo itu akan bergerak kepada orang seterusnya. Kaunter di Papan Pemuka Perkhidmatan anda menunjukkan berapa banyak yang masih belum diambil tindakan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**D Flow Action** lists the memos waiting on you.\n\nOpen one, record your action, and it moves on to the next person. The **D Flow** card on the Home page shows a yellow badge (for example *3 to act*) when memos are waiting.",
                // 'ms' => "**D Flow Action** menyenaraikan memo yang menunggu tindakan anda.\n\nBuka satu memo, rekodkan tindakan anda, dan memo itu akan bergerak kepada orang seterusnya. Kad **D Flow** di Laman Utama memaparkan lencana kuning (contohnya *3 perlu tindakan*) apabila ada memo yang menunggu.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**D Flow Action** lists the memos waiting on you.\n\nOpen one, record your action, and it moves on to the next person. The **D Flow** card on the Home page shows a yellow badge (for example *3 to act*) when memos are waiting.\n\n- **Staff:** Home page → **D Flow** card → **D Flow Action**.\n- **D Flow administrators:** the same popup shows **D Flow (Action)** with the number waiting next to it.",
                // 'ms' => "**D Flow Action** menyenaraikan memo yang menunggu tindakan anda.\n\nBuka satu memo, rekodkan tindakan anda, dan memo itu akan bergerak kepada orang seterusnya. Kad **D Flow** di Laman Utama memaparkan lencana kuning (contohnya *3 perlu tindakan*) apabila ada memo yang menunggu.\n\n- **Kakitangan:** Laman Utama → kad **D Flow** → **D Flow Action**.\n- **Pentadbir D Flow:** tetingkap yang sama memaparkan **D Flow (Action)** berserta bilangan yang menunggu di sebelahnya.",
                // #================================
                'en' => "**D Flow Action** lists the memos waiting on you.\n\nOpen the **D Flow** card on the Home page and choose **D Flow Action**. Open a memo, record your action, and it moves on to the next person. The card shows a yellow badge (for example *3 to act*) when memos are waiting.",
                'ms' => "**D Flow Action** menyenaraikan memo yang menunggu tindakan anda.\n\nBuka kad **D Flow** di Laman Utama dan pilih **D Flow Action**. Buka satu memo, rekodkan tindakan anda, dan memo itu akan bergerak kepada orang seterusnya. Kad itu memaparkan lencana kuning (contohnya *3 perlu tindakan*) apabila ada memo yang menunggu.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // D Flow admins see the option as "D Flow (Action)" with the count
            'admin'    => [
                'roles'  => ['ROLE_EMINITADMIN', 'ROLE_SUPERADMIN'],
                'answer' => [
                    'en' => "**D Flow Action** lists the memos waiting on you.\n\nOpen the **D Flow** card (on the Home page or the **Admin** / **Super Admin** page) and choose **D Flow (Action)** — the number next to it is how many are waiting. Open a memo, record your action, and it moves on to the next person.",
                    'ms' => "**D Flow Action** menyenaraikan memo yang menunggu tindakan anda.\n\nBuka kad **D Flow** (di Laman Utama atau halaman **Admin** / **Super Admin**) dan pilih **D Flow (Action)** — nombor di sebelahnya ialah bilangan yang menunggu. Buka satu memo, rekodkan tindakan anda, dan memo itu akan bergerak kepada orang seterusnya.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'dflow-admin',
            'title'    => [
                'en' => 'EMA — D Flow Action (administrator view)',
                'ms' => 'EMA — D Flow Action (paparan pentadbir)',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                'ema', 'd flow admin', 'dflow admin', 'memo admin', 'eminit admin',
                'all memos', 'manage memo', 'admin memo', 'semua memo', 'urus memo',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_EMINITADMIN'],
            // #================================
            'roles'    => ['ROLE_EMINITADMIN', 'ROLE_SUPERADMIN'],
            // #================================
            'url'      => 'eminit.eminit.indexeminitadmin',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**EMA — D Flow Action** is the administrator view of every memo in the system, used to monitor and unblock memos across departments.",
                // 'ms' => "**EMA — D Flow Action** ialah paparan pentadbir bagi setiap memo dalam sistem, digunakan untuk memantau dan melancarkan semula memo merentas jabatan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**EMA — D Flow Action** is the administrator view of every memo in the system, used to monitor and unblock memos across departments.\n\nOpen it from the **D Flow** card on the Home page and choose **List of D Flow** (the card shows an *Admin* label for administrators).",
                // 'ms' => "**EMA — D Flow Action** ialah paparan pentadbir bagi setiap memo dalam sistem, digunakan untuk memantau dan melancarkan semula memo merentas jabatan.\n\nBuka melalui kad **D Flow** di Laman Utama dan pilih **List of D Flow** (kad itu memaparkan label *Pentadbir* bagi pentadbir).",
                // #================================
                'en' => "**EMA — D Flow Action** is the administrator view of every memo in the system, used to monitor and unblock memos across departments.\n\nD Flow administrators open the **D Flow** card (it shows an *Admin* label) — on the Home page or on the **Admin** page — and get four options:\n\n- **List of D Flow** — every memo in the system.\n- **Create D Flow** — raise a memo.\n- **D Flow (Action)** — memos waiting on you, with the count.\n- **Settings** — D Flow settings.",
                'ms' => "**EMA — D Flow Action** ialah paparan pentadbir bagi setiap memo dalam sistem, digunakan untuk memantau dan melancarkan semula memo merentas jabatan.\n\nPentadbir D Flow membuka kad **D Flow** (ia memaparkan label *Pentadbir*) — di Laman Utama atau di halaman **Admin** — dan mendapat empat pilihan:\n\n- **List of D Flow** — setiap memo dalam sistem.\n- **Create D Flow** — hantar memo.\n- **D Flow (Action)** — memo yang menunggu tindakan anda, berserta bilangannya.\n- **Settings** — tetapan D Flow.",
                // #================================
            ],
        ],
        [
            'id'       => 'mns',
            'title'    => [
                'en' => 'MESH Notification Service (MNS)',
                'ms' => 'MESH Notification Service (MNS)',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                // #============= ORI CODE ==============
                // 'mns', 'notification', 'notifications', 'notis', 'announcement', 'announcements',
                // 'pengumuman', 'alert', 'broadcast', 'notification service', 'pemberitahuan',
                // 'makluman',
                // #================================
                // announcement / pengumuman words moved to the new 'announcements' FAQ (header bell)
                'mns', 'notification service', 'broadcast', 'whatsapp', 'whatsapp message',
                'send whatsapp', 'bulk message', 'mass message', 'sms', 'hantar whatsapp',
                'mesej whatsapp', 'mesej pukal', 'pemberitahuan', 'notifikasi', 'makluman',
                'no penerima', 'notification',
                // #================================
            ],
            // #============= ORI CODE ==============
            // // #========== NEWLY ADDED ============
            // // Route is restricted (checkRole:ROLE_ONS_USER|ROLE_SUPERADMIN); Home shows "Access required" to everyone else
            // 'roles'    => ['ROLE_ONS_USER', 'ROLE_SUPERADMIN'],
            // // #================================
            // #================================
            // Senders need ROLE_ONS_USER (Home card); MNS administrators (ROLE_ONS_ADMIN) get the admin list on the Admin page
            'roles'    => ['ROLE_ONS_USER', 'ROLE_ONS_ADMIN', 'ROLE_SUPERADMIN'],
            // #================================
            'url'      => 'onlinenotifications.onlinenotification.indexuser',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**MESH Notification Service (MNS)** carries in-app and email notices to staff or to a whole group.\n\nYour unread notices also appear in the bell icon on the top navigation bar.",
                // 'ms' => "**MESH Notification Service (MNS)** menyampaikan notis dalam sistem dan melalui e-mel kepada kakitangan atau kepada satu kumpulan.\n\nNotis anda yang belum dibaca juga muncul pada ikon loceng di bar navigasi atas.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**MESH Notification Service (MNS)** broadcasts official messages and documents to many recipients at once through **WhatsApp** (WhatsApp API).\n\nOpen it from the **MNS** card on the Home page (under *Communication & Notifications*), add the recipients' phone numbers with **Tambah Nombor Telefon**, then fill in *Perkara* and *Teks*.\n\nLooking for ministry announcements instead? Those are in the **bell icon** at the top right.",
                // 'ms' => "**MESH Notification Service (MNS)** menghantar mesej dan dokumen rasmi kepada ramai penerima serentak melalui **WhatsApp** (API WhatsApp).\n\nBuka melalui kad **MNS** di Laman Utama (di bawah *Komunikasi & Pemberitahuan*), tambah nombor telefon penerima dengan **Tambah Nombor Telefon**, kemudian isikan *Perkara* dan *Teks*.\n\nMencari pengumuman kementerian? Pengumuman ada di **ikon loceng** di bahagian atas kanan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**MESH Notification Service (MNS)** broadcasts official messages and documents to many recipients at once through **WhatsApp** (WhatsApp API).\n\n- **Senders** (MNS user role): open the **MNS** card on the Home page (under *Communication & Notifications*), add the recipients' phone numbers with **Tambah Nombor Telefon**, then fill in *Perkara* and *Teks*. Your sent messages are listed below the form.\n- **MNS administrators:** open **MNS** on the **Admin** page to see the messages sent by everyone.\n\nWithout the role, the MNS card shows *Access required* — request it through **Role Access**. Looking for ministry announcements instead? Those are in the **bell icon** at the top right.",
                // 'ms' => "**MESH Notification Service (MNS)** menghantar mesej dan dokumen rasmi kepada ramai penerima serentak melalui **WhatsApp** (API WhatsApp).\n\n- **Penghantar** (peranan pengguna MNS): buka kad **MNS** di Laman Utama (di bawah *Komunikasi & Pemberitahuan*), tambah nombor telefon penerima dengan **Tambah Nombor Telefon**, kemudian isikan *Perkara* dan *Teks*. Mesej yang anda hantar disenaraikan di bawah borang.\n- **Pentadbir MNS:** buka **MNS** di halaman **Admin** untuk melihat mesej yang dihantar oleh semua pengguna.\n\nTanpa peranan itu, kad MNS memaparkan *Akses diperlukan* — mohon melalui **Role Access**. Mencari pengumuman kementerian? Pengumuman ada di **ikon loceng** di bahagian atas kanan.",
                // #================================
                // The bot itself adds the "you need a role" note for users without one
                'en' => "**MESH Notification Service (MNS)** broadcasts official messages and documents to many recipients at once through **WhatsApp** (WhatsApp API).\n\nOpen it from the **MNS** card on the Home page (under *Communication & Notifications*), add the recipients' phone numbers with **Tambah Nombor Telefon**, then fill in *Perkara* and *Teks*. Your sent messages are listed below the form.\n\nLooking for ministry announcements instead? Those are in the **bell icon** at the top right.",
                'ms' => "**MESH Notification Service (MNS)** menghantar mesej dan dokumen rasmi kepada ramai penerima serentak melalui **WhatsApp** (API WhatsApp).\n\nBuka melalui kad **MNS** di Laman Utama (di bawah *Komunikasi & Pemberitahuan*), tambah nombor telefon penerima dengan **Tambah Nombor Telefon**, kemudian isikan *Perkara* dan *Teks*. Mesej yang anda hantar disenaraikan di bawah borang.\n\nMencari pengumuman kementerian? Pengumuman ada di **ikon loceng** di bahagian atas kanan.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin / Super Admin page -> MNS (onlinenotifications.onlinenotification.index)
            'admin'    => [
                'roles'  => ['ROLE_ONS_ADMIN', 'ROLE_SUPERADMIN'],
                'url'    => 'onlinenotifications.onlinenotification.index',
                'answer' => [
                    'en' => "**MESH Notification Service (MNS)** broadcasts official messages and documents to many recipients at once through **WhatsApp** (WhatsApp API).\n\nOpen **MNS** from the **Admin** or **Super Admin** page in the side menu to see the messages sent by everyone. To send one yourself, use the **MNS** card on the Home page.",
                    'ms' => "**MESH Notification Service (MNS)** menghantar mesej dan dokumen rasmi kepada ramai penerima serentak melalui **WhatsApp** (API WhatsApp).\n\nBuka **MNS** dari halaman **Admin** atau **Super Admin** di menu sisi untuk melihat mesej yang dihantar oleh semua pengguna. Untuk menghantar sendiri, gunakan kad **MNS** di Laman Utama.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'mls',
            'title'    => [
                'en' => 'MESH Link Sharing (MLS)',
                'ms' => 'MESH Link Sharing (MLS)',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                'mls', 'link sharing', 'shared link', 'links', 'linkup', 'share link',
                'resources', 'pautan', 'kongsi pautan', 'sumber',
                // #========== NEWLY ADDED ============
                'short link', 'shorten link', 'shortened link', 'url shortener', 'qr', 'qr code',
                'make qr', 'pautan pendek', 'pendekkan pautan', 'kod qr', 'buat kod qr',
                // #================================
            ],
            'url'      => 'linkup.index',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**MESH Link Sharing (MLS)** is where shared links and resources are published for staff.",
                // 'ms' => "**MESH Link Sharing (MLS)** ialah tempat pautan dan sumber yang dikongsi diterbitkan untuk kakitangan.",
                // #================================
                'en' => "**MESH Link Sharing (MLS)** turns a long web address into a **short link** and a **QR code** that are easy to share and refer to.\n\nOpen it from the **MLS** card on the Home page (under *Communication & Notifications*).",
                'ms' => "**MESH Link Sharing (MLS)** menukar alamat web yang panjang kepada **pautan pendek** dan **kod QR** yang mudah dikongsi dan dirujuk.\n\nBuka melalui kad **MLS** di Laman Utama (di bawah *Komunikasi & Pemberitahuan*).",
                // #================================
            ],
        ],
        // #========== NEWLY ADDED ============
        // FSD (File Sharing Drive) — FSD card on the Home page (inc/home-services.blade.php), route fsm.fsm.index
        [
            'id'       => 'fsd',
            'title'    => [
                'en' => 'File Sharing Drive (FSD)',
                'ms' => 'File Sharing Drive (FSD) — perkongsian fail',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                'fsd', 'fsm', 'f.s.m', 'file sharing', 'file sharing drive', 'drive', 'share file',
                'share files', 'share folder', 'upload file', 'upload', 'folder', 'shared folder',
                'documents', 'kongsi fail', 'perkongsian fail', 'muat naik', 'muat naik fail',
                'fail', 'folder dikongsi',
            ],
            'url'      => 'fsm.fsm.index',
            'answer'   => [
                'en' => "**File Sharing Drive (FSD)** is where you upload, organise and share files and folders.\n\nOpen it from the **FSD** card on the Home page (under *Communication & Notifications*). You can create folders, add documents, and grant other staff access to a folder — and remove that access later.",
                'ms' => "**File Sharing Drive (FSD)** ialah tempat anda memuat naik, menyusun dan berkongsi fail serta folder.\n\nBuka melalui kad **FSD** di Laman Utama (di bawah *Komunikasi & Pemberitahuan*). Anda boleh mencipta folder, menambah dokumen, dan memberi akses folder kepada kakitangan lain — serta menarik balik akses itu kemudian.",
            ],
        ],
        // #================================
        [
            'id'       => 'qna',
            'title'    => [
                'en' => 'Q&A Service',
                'ms' => 'Q&A Service (Perkhidmatan Soal Jawab)',
            ],
            'category' => ['en' => 'Communication & documents', 'ms' => 'Komunikasi & dokumen'],
            'keywords' => [
                'q&a', 'qna', 'q and a', 'question service', 'ask question', 'soalan',
                'tanya', 'faq service', 'soal jawab',
                // #========== NEWLY ADDED ============
                'anonymous question', 'anonymous', 'ask anonymously', 'training question',
                'event question', 'briefing question', 'soalan tanpa nama', 'tanpa nama',
                'soalan taklimat', 'taklimat',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'url'      => '/servicesdashboard',
            // #================================
            'url'      => '/Q&A',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "The **Q&A Service** on the Services Dashboard is where you submit a question to the relevant department and read answers that have already been published.",
                // 'ms' => "**Q&A Service** di Papan Pemuka Perkhidmatan ialah tempat anda menghantar soalan kepada jabatan berkaitan dan membaca jawapan yang telah diterbitkan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "The **Q&A Service** lets you submit questions **anonymously** during a training session, briefing or event.\n\nOpen it from the **Q&A** card on the Home page (under *Attendance & Events*).",
                // 'ms' => "**Q&A Service** membolehkan anda menghantar soalan **tanpa nama** semasa sesi latihan, taklimat atau acara.\n\nBuka melalui kad **Q&A** di Laman Utama (di bawah *Kehadiran & Acara*).",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "The **Q&A Service** lets you submit questions **anonymously** during a training session, briefing or event.\n\n- **Staff:** open the **Q&A** card on the Home page (under *Attendance & Events*) — it goes straight to the question form.\n- **Q&A administrators:** open **Q&A** on the **Admin** page to set up the sessions and read the questions submitted.",
                // 'ms' => "**Q&A Service** membolehkan anda menghantar soalan **tanpa nama** semasa sesi latihan, taklimat atau acara.\n\n- **Kakitangan:** buka kad **Q&A** di Laman Utama (di bawah *Kehadiran & Acara*) — ia terus ke borang soalan.\n- **Pentadbir Q&A:** buka **Q&A** di halaman **Admin** untuk menyediakan sesi dan membaca soalan yang dihantar.",
                // #================================
                'en' => "The **Q&A Service** lets you submit questions **anonymously** during a training session, briefing or event.\n\nOpen it from the **Q&A** card on the Home page (under *Attendance & Events*).",
                'ms' => "**Q&A Service** membolehkan anda menghantar soalan **tanpa nama** semasa sesi latihan, taklimat atau acara.\n\nBuka melalui kad **Q&A** di Laman Utama (di bawah *Kehadiran & Acara*).",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin / Super Admin page -> Q&A (st.soalantaklimat.indexadmin)
            'admin'    => [
                'roles'  => ['ROLE_QUESTION&ANSWER', 'ROLE_SUPERADMIN'],
                'url'    => 'st.soalantaklimat.indexadmin',
                'answer' => [
                    'en' => "The **Q&A Service** lets staff submit questions **anonymously** during a training session, briefing or event.\n\nOpen **Q&A** from the **Admin** or **Super Admin** page in the side menu to set up the sessions and read the questions submitted.",
                    'ms' => "**Q&A Service** membolehkan kakitangan menghantar soalan **tanpa nama** semasa sesi latihan, taklimat atau acara.\n\nBuka **Q&A** dari halaman **Admin** atau **Super Admin** di menu sisi untuk menyediakan sesi dan membaca soalan yang dihantar.",
                ],
            ],
            // #================================
        ],

        /* ---------------------------------------------------------------
         | Attendance and events
         * --------------------------------------------------------------- */

        [
            'id'       => 'mas',
            'title'    => [
                'en' => 'MESH Attendance Slip (MAS)',
                'ms' => 'MESH Attendance Slip (MAS)',
            ],
            'category' => ['en' => 'Attendance & events', 'ms' => 'Kehadiran & acara'],
            'keywords' => [
                'mas', 'attendance slip', 'slip kehadiran', 'slip', 'attendance',
                'kehadiran', 'clock in', 'punch card', 'rekod kehadiran',
                // #========== NEWLY ADDED ============
                'slip kedatangan', 'meeting attendance', 'kehadiran mesyuarat', 'sk',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_SLIPKEHADIRAN'],
            // 'url'      => '/servicesdashboard',
            // #================================
            // The slip form (/sk) is open to all staff; ROLE_SLIPKEHADIRAN is only for the admin side
            'url'      => 'slipkehadiran',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**MESH Attendance Slip (MAS)** issues and records staff attendance slips. Find it on the Services Dashboard.",
                // 'ms' => "**MESH Attendance Slip (MAS)** mengeluarkan dan merekodkan slip kehadiran kakitangan. Ia boleh didapati di Papan Pemuka Perkhidmatan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions.\n\nOpen it from the **MAS** card on the Home page (under *Attendance & Events*), choose the event, and select your role — for example *Pengerusi*, *Ahli*, *Setiausaha* or *Hadir*.",
                // 'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian.\n\nBuka melalui kad **MAS** di Laman Utama (di bawah *Kehadiran & Acara*), pilih acara, dan pilih peranan anda — contohnya *Pengerusi*, *Ahli*, *Setiausaha* atau *Hadir*.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions.\n\n- **Staff:** open the **MAS** card on the Home page (under *Attendance & Events*). It goes straight to the slip form — choose the event and your role, for example *Pengerusi*, *Ahli*, *Setiausaha* or *Hadir*.\n- **MAS administrators:** open **MAS** on the **Admin** page to set up events (*perkara*) and see every slip submitted. You can still fill in the form yourself from the Home page.",
                // 'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian.\n\n- **Kakitangan:** buka kad **MAS** di Laman Utama (di bawah *Kehadiran & Acara*). Ia terus ke borang slip — pilih acara dan peranan anda, contohnya *Pengerusi*, *Ahli*, *Setiausaha* atau *Hadir*.\n- **Pentadbir MAS:** buka **MAS** di halaman **Admin** untuk menyediakan acara (*perkara*) dan melihat setiap slip yang dihantar. Anda masih boleh mengisi borang sendiri dari Laman Utama.",
                // #================================
                // Staff: Home -> MAS -> /sk (form). Admins / super admins: Admin or Super Admin page -> MAS -> /sk/indexadmin,
                // which has a button at the top right back to the form (/sk)
                // #============= ORI CODE ==============
                // 'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions. Everyone can fill in the slip; administrators also manage it.\n\n- **Staff:** Home page → **MAS** card (under *Attendance & Events*). It opens the slip form straight away — choose the event and your role, for example *Pengerusi*, *Ahli*, *Setiausaha* or *Hadir*.\n- **MAS administrators and super administrators:** **Admin** page (or **Super Admin** page) → **MAS**. This opens the MAS admin page, where you set up events (*perkara*) and see every slip submitted. The button at the top right of that page opens the slip form, so you can fill one in yourself too.",
                // 'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian. Semua orang boleh mengisi slip; pentadbir juga menguruskannya.\n\n- **Kakitangan:** Laman Utama → kad **MAS** (di bawah *Kehadiran & Acara*). Ia terus membuka borang slip — pilih acara dan peranan anda, contohnya *Pengerusi*, *Ahli*, *Setiausaha* atau *Hadir*.\n- **Pentadbir MAS dan pentadbir super:** halaman **Admin** (atau **Super Admin**) → **MAS**. Ini membuka halaman pentadbir MAS, tempat anda menyediakan acara (*perkara*) dan melihat setiap slip yang dihantar. Butang di bahagian atas kanan halaman itu membuka borang slip, jadi anda juga boleh mengisinya sendiri.",
                // #================================
                // #============= ORI CODE ==============
                // // Same flow, without the Staff / Administrator labels
                // 'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions.\n\n1. On the **Home** page, open the **MAS** card (under *Attendance & Events*) to go to the slip form.\n2. Choose the event and your role in it, for example *Pengerusi*, *Ahli*, *Setiausaha* or *Hadir*, then submit.\n\nTo set up events (*perkara*) and see every slip submitted, open **MAS** from the **Admin** or **Super Admin** page. The button at the top right of that page opens the slip form.",
                // 'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian.\n\n1. Di **Laman Utama**, buka kad **MAS** (di bawah *Kehadiran & Acara*) untuk ke borang slip.\n2. Pilih acara dan peranan anda, contohnya *Pengerusi*, *Ahli*, *Setiausaha* atau *Hadir*, kemudian hantar.\n\nUntuk menyediakan acara (*perkara*) dan melihat setiap slip yang dihantar, buka **MAS** dari halaman **Admin** atau **Super Admin**. Butang di bahagian atas kanan halaman itu membuka borang slip.",
                // #================================
                // #============= ORI CODE ==============
                // // Admin-page sentence removed; direct link to the slip form added
                // 'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions.\n\n1. On the **Home** page, open the **MAS** card (under *Attendance & Events*) to go to the slip form: https://mesh.moe.gov.bn/sk\n2. Choose the event and your role in it, for example *Pengerusi*, *Ahli*, *Setiausaha* or *Hadir*, then submit.",
                // 'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian.\n\n1. Di **Laman Utama**, buka kad **MAS** (di bawah *Kehadiran & Acara*) untuk ke borang slip: https://mesh.moe.gov.bn/sk\n2. Pilih acara dan peranan anda, contohnya *Pengerusi*, *Ahli*, *Setiausaha* atau *Hadir*, kemudian hantar.",
                // #================================
                // Same layout as FSD: what it is, then where to open it. The bot adds "Go there" from 'url'.
                'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions.\n\nOpen it from the **MAS** card on the Home page (under *Attendance & Events*), choose the event, and select your role in it — for example *Pengerusi*, *Ahli*, *Setiausaha* or *Hadir*.",
                'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian.\n\nBuka melalui kad **MAS** di Laman Utama (di bawah *Kehadiran & Acara*), pilih acara, dan pilih peranan anda — contohnya *Pengerusi*, *Ahli*, *Setiausaha* atau *Hadir*.",
                // #================================
                // #================================
                // #================================
                // #================================
                // #================================
            ],
            // #============= ORI CODE ==============
            // // #========== NEWLY ADDED ============
            // // Shown INSTEAD of 'answer' / 'url' to users who hold one of these roles (MAS card on the
            // // Admin / Super Admin page: ROLE_SUPERADMIN || ROLE_SLIPKEHADIRAN). Needs the bot engine to read 'admin'.
            // 'admin'    => [
            //     'roles'  => ['ROLE_SLIPKEHADIRAN', 'ROLE_SUPERADMIN'],
            //     'url'    => '/sk/indexadmin',
            //     'answer' => [
            //         'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions.\n\n1. Open the **Admin** or **Super Admin** page from the side menu and click **MAS**. It opens the MAS admin page: https://mesh.moe.gov.bn/sk/indexadmin\n2. There you set up events (*perkara*) and see every slip submitted.\n3. To fill in a slip yourself, use the button at the top right of that page. It opens the slip form: https://mesh.moe.gov.bn/sk",
            //         'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian.\n\n1. Buka halaman **Admin** atau **Super Admin** dari menu sisi dan klik **MAS**. Ia membuka halaman pentadbir MAS: https://mesh.moe.gov.bn/sk/indexadmin\n2. Di situ anda menyediakan acara (*perkara*) dan melihat setiap slip yang dihantar.\n3. Untuk mengisi slip sendiri, gunakan butang di bahagian atas kanan halaman itu. Ia membuka borang slip: https://mesh.moe.gov.bn/sk",
            //     ],
            // ],
            // // #================================
            // #================================
            // Shown INSTEAD of 'answer' / 'url' to users holding one of these roles (SmartBotResponder::render)
            'admin'    => [
                'roles'  => ['ROLE_SLIPKEHADIRAN', 'ROLE_SUPERADMIN'],
                'url'    => 'sk.slipkedatangan.indexadmin',
                'answer' => [
                    'en' => "**MESH Attendance Slip (MAS)** is the attendance slip for Ministry events, meetings and training sessions.\n\nOpen **MAS** from the **Admin** or **Super Admin** page in the side menu to set up events (*perkara*) and see every slip submitted. The button at the top right of that page opens the slip form.",
                    'ms' => "**MESH Attendance Slip (MAS)** ialah slip kehadiran untuk acara, mesyuarat dan sesi latihan Kementerian.\n\nBuka **MAS** dari halaman **Admin** atau **Super Admin** di menu sisi untuk menyediakan acara (*perkara*) dan melihat setiap slip yang dihantar. Butang di bahagian atas kanan halaman itu membuka borang slip.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'mea',
            'title'    => [
                'en' => 'MESH Event Attendance (MEA)',
                'ms' => 'MESH Event Attendance (MEA)',
            ],
            'category' => ['en' => 'Attendance & events', 'ms' => 'Kehadiran & acara'],
            'keywords' => [
                'mea', 'event attendance', 'event', 'events', 'acara', 'kehadiran acara',
                'moe event', 'register event', 'majlis', 'daftar acara',
                // #========== NEWLY ADDED ============
                'check in', 'check-in', 'daftar masuk', 'moeevent', 'participant', 'peserta',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_ATTENDANCE_EVENT', 'ROLE_MOEEVENT'],
            // 'url'      => '/servicesdashboard',
            // #================================
            // The check-in form (/moeevent) is open to all staff; ROLE_MOEEVENT manages events from the Admin page
            'url'      => '/moeevent',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**MESH Event Attendance (MEA)** records who attended ministry events, including QR-based check-in on the day.",
                // 'ms' => "**MESH Event Attendance (MEA)** merekodkan siapa yang hadir ke acara kementerian, termasuk daftar masuk menggunakan kod QR pada hari acara.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**MESH Event Attendance (MEA)** manages attendance for Ministry activities — participant check-in and attendance records for meetings, discussions, training sessions and other official activities.\n\nOpen it from the **MEA** card on the Home page (under *Attendance & Events*). Event organisers with the event role manage the events themselves.",
                // 'ms' => "**MESH Event Attendance (MEA)** mengurus kehadiran bagi aktiviti Kementerian — daftar masuk peserta dan rekod kehadiran untuk mesyuarat, perbincangan, sesi latihan dan aktiviti rasmi lain.\n\nBuka melalui kad **MEA** di Laman Utama (di bawah *Kehadiran & Acara*). Penganjur yang mempunyai peranan acara menguruskan acara itu sendiri.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**MESH Event Attendance (MEA)** manages attendance for Ministry activities — participant check-in and attendance records for meetings, discussions, training sessions and other official activities.\n\n- **Staff / participants:** open the **MEA** card on the Home page (under *Attendance & Events*). It goes straight to the check-in form.\n- **MEA administrators:** open **MEA** on the **Admin** page to create and manage events and see who checked in.",
                // 'ms' => "**MESH Event Attendance (MEA)** mengurus kehadiran bagi aktiviti Kementerian — daftar masuk peserta dan rekod kehadiran untuk mesyuarat, perbincangan, sesi latihan dan aktiviti rasmi lain.\n\n- **Kakitangan / peserta:** buka kad **MEA** di Laman Utama (di bawah *Kehadiran & Acara*). Ia terus ke borang daftar masuk.\n- **Pentadbir MEA:** buka **MEA** di halaman **Admin** untuk mencipta dan mengurus acara serta melihat siapa yang telah mendaftar masuk.",
                // #================================
                // Staff: Home -> MEA -> /moeevent (check-in form). Admins / super admins: Admin or Super Admin page -> MEA ->
                // /moeevent/indexadmin (moeevent/indexadmin.blade.php): top-right link button opens /moeevent in a new tab, "+" creates an event.
                // Super admins see every event; ROLE_MOEEVENT sees their own department's events (MoeeventController@indexadmin)
                // #============= ORI CODE ==============
                // 'en' => "**MESH Event Attendance (MEA)** manages attendance for Ministry activities — participant check-in and attendance records for meetings, discussions, training sessions and other official activities. Everyone can check in; administrators also run the events.\n\n- **Staff / participants:** Home page → **MEA** card (under *Attendance & Events*). It opens the check-in form straight away.\n- **MEA administrators and super administrators:** **Admin** page (or **Super Admin** page) → **MEA**. This opens the MOE Event admin page:\n  - the **link** button at the top right opens the check-in form in a new tab;\n  - the **+** button creates a new event;\n  - each event has its **QR code** (download as PDF or image) and buttons for **Ratings**, **Edit**, **Delete**, **Approve Participant**, **Dashboard** and **Add CC Person**.\n\nSuper administrators see every event; MEA administrators see their own department's events.",
                // 'ms' => "**MESH Event Attendance (MEA)** mengurus kehadiran bagi aktiviti Kementerian — daftar masuk peserta dan rekod kehadiran untuk mesyuarat, perbincangan, sesi latihan dan aktiviti rasmi lain. Semua orang boleh mendaftar masuk; pentadbir juga menguruskan acara.\n\n- **Kakitangan / peserta:** Laman Utama → kad **MEA** (di bawah *Kehadiran & Acara*). Ia terus membuka borang daftar masuk.\n- **Pentadbir MEA dan pentadbir super:** halaman **Admin** (atau **Super Admin**) → **MEA**. Ini membuka halaman pentadbir MOE Event:\n  - butang **pautan** di bahagian atas kanan membuka borang daftar masuk dalam tab baharu;\n  - butang **+** mencipta acara baharu;\n  - setiap acara mempunyai **kod QR** (muat turun sebagai PDF atau imej) dan butang **Ratings**, **Edit**, **Delete**, **Approve Participant**, **Dashboard** dan **Add CC Person**.\n\nPentadbir super melihat semua acara; pentadbir MEA melihat acara jabatan mereka sendiri.",
                // #================================
                // #============= ORI CODE ==============
                // // Same flow, without the Staff / Administrator labels
                // 'en' => "**MESH Event Attendance (MEA)** manages attendance for Ministry activities — participant check-in and attendance records for meetings, discussions, training sessions and other official activities.\n\nOn the **Home** page, open the **MEA** card (under *Attendance & Events*) to go to the check-in form.\n\nTo run events, open **MEA** from the **Admin** or **Super Admin** page:\n\n- The **link** button at the top right opens the check-in form in a new tab.\n- The **+** button creates a new event.\n- Each event has its **QR code** (PDF or image) and buttons for **Ratings**, **Edit**, **Delete**, **Approve Participant**, **Dashboard** and **Add CC Person**.",
                // 'ms' => "**MESH Event Attendance (MEA)** mengurus kehadiran bagi aktiviti Kementerian — daftar masuk peserta dan rekod kehadiran untuk mesyuarat, perbincangan, sesi latihan dan aktiviti rasmi lain.\n\nDi **Laman Utama**, buka kad **MEA** (di bawah *Kehadiran & Acara*) untuk ke borang daftar masuk.\n\nUntuk menguruskan acara, buka **MEA** dari halaman **Admin** atau **Super Admin**:\n\n- Butang **pautan** di bahagian atas kanan membuka borang daftar masuk dalam tab baharu.\n- Butang **+** mencipta acara baharu.\n- Setiap acara mempunyai **kod QR** (PDF atau imej) dan butang **Ratings**, **Edit**, **Delete**, **Approve Participant**, **Dashboard** dan **Add CC Person**.",
                // #================================
                // Normal users only; the admin view is in 'admin' below
                'en' => "**MESH Event Attendance (MEA)** manages attendance for Ministry activities — participant check-in and attendance records for meetings, discussions, training sessions and other official activities.\n\nOpen it from the **MEA** card on the Home page (under *Attendance & Events*) to check in to an event.",
                'ms' => "**MESH Event Attendance (MEA)** mengurus kehadiran bagi aktiviti Kementerian — daftar masuk peserta dan rekod kehadiran untuk mesyuarat, perbincangan, sesi latihan dan aktiviti rasmi lain.\n\nBuka melalui kad **MEA** di Laman Utama (di bawah *Kehadiran & Acara*) untuk mendaftar masuk ke sesuatu acara.",
                // #================================
                // #================================
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin / Super Admin page -> MEA (moeevent.moeevent.indexadmin)
            'admin'    => [
                'roles'  => ['ROLE_MOEEVENT', 'ROLE_SUPERADMIN'],
                'url'    => 'moeevent.moeevent.indexadmin',
                'answer' => [
                    'en' => "**MESH Event Attendance (MEA)** manages attendance for Ministry activities — participant check-in and attendance records for meetings, discussions, training sessions and other official activities.\n\nOpen **MEA** from the **Admin** or **Super Admin** page in the side menu. Create an event with the **+** button, then manage it from its row — **QR code** (PDF or image), **Ratings**, **Edit**, **Delete**, **Approve Participant**, **Dashboard** and **Add CC Person**. The **link** button at the top right opens the check-in form in a new tab.",
                    'ms' => "**MESH Event Attendance (MEA)** mengurus kehadiran bagi aktiviti Kementerian — daftar masuk peserta dan rekod kehadiran untuk mesyuarat, perbincangan, sesi latihan dan aktiviti rasmi lain.\n\nBuka **MEA** dari halaman **Admin** atau **Super Admin** di menu sisi. Cipta acara dengan butang **+**, kemudian uruskannya dari barisnya — **kod QR** (PDF atau imej), **Ratings**, **Edit**, **Delete**, **Approve Participant**, **Dashboard** dan **Add CC Person**. Butang **pautan** di bahagian atas kanan membuka borang daftar masuk dalam tab baharu.",
                ],
            ],
            // #================================
        ],

        /* ---------------------------------------------------------------
         | Bookings
         * --------------------------------------------------------------- */

        [
            'id'       => 'mrb',
            'title'    => [
                'en' => 'Meeting Room Booking (MRB)',
                'ms' => 'Meeting Room Booking (MRB) — tempahan bilik mesyuarat',
            ],
            'category' => ['en' => 'Bookings', 'ms' => 'Tempahan'],
            'keywords' => [
                'mrb', 'meeting room', 'book room', 'room booking', 'booking', 'reserve room',
                'bilik mesyuarat', 'tempah bilik', 'tempahan', 'meeting', 'mesyuarat',
                'book a room', 'tempah bilik mesyuarat', 'tempahan bilik',
                // #========== NEWLY ADDED ============
                'room availability', 'free room', 'kekosongan bilik', 'bilik kosong',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'url'      => 'bookings.booking.home',
            // #================================
            // Home's MRB popup opens these pages (Search Room Availability first); bookings.booking.home is SRB
            'url'      => 'adminbooking.searchroomadmin',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Meeting Room Booking (MRB)** is where you reserve a meeting room.\n\n1. Open MRB from the Services Dashboard.\n2. Pick your date and time, then search for a free room.\n3. Confirm the booking.\n\nThe calendar view shows what is already taken before you commit.",
                // 'ms' => "**Meeting Room Booking (MRB)** ialah tempat anda menempah bilik mesyuarat.\n\n1. Buka MRB dari Papan Pemuka Perkhidmatan.\n2. Pilih tarikh dan masa anda, kemudian cari bilik yang kosong.\n3. Sahkan tempahan anda.\n\nPaparan kalendar menunjukkan bilik yang telah ditempah sebelum anda mengesahkan.",
                // #================================
                'en' => "**Meeting Room Booking (MRB)** is where you reserve a meeting room.\n\n1. On the Home page, open **Facility Booking Management** (under *Facilities & Support*) and choose **MRB**.\n2. Use **Search Room Availability** to pick your date and time and find a free room.\n3. Confirm it under **Booking**.\n\n**Calendar** shows what is already taken before you commit, and **Room** lists the rooms.",
                'ms' => "**Meeting Room Booking (MRB)** ialah tempat anda menempah bilik mesyuarat.\n\n1. Di Laman Utama, buka **Pengurusan Tempahan Kemudahan** (di bawah *Kemudahan & Sokongan*) dan pilih **MRB**.\n2. Gunakan **Cari Kekosongan Bilik** untuk memilih tarikh dan masa serta mencari bilik yang kosong.\n3. Sahkan di bawah **Tempahan**.\n\n**Kalendar** menunjukkan bilik yang telah ditempah sebelum anda mengesahkan, dan **Bilik** menyenaraikan bilik-bilik.",
                // #================================
            ],
        ],
        [
            'id'       => 'srb',
            'title'    => [
                'en' => 'Syndicate Room Booking (SRB)',
                'ms' => 'Syndicate Room Booking (SRB) — tempahan bilik sindiket',
            ],
            'category' => ['en' => 'Bookings', 'ms' => 'Tempahan'],
            'keywords' => [
                'srb', 'syndicate room', 'syndicate', 'small room', 'bilik sindiket',
                'tempah bilik sindiket',
            ],
            'url'      => 'bookings.booking.home',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Syndicate Room Booking (SRB)** reserves syndicate rooms. It works the same way as Meeting Room Booking — pick a slot, search, confirm.",
                // 'ms' => "**Syndicate Room Booking (SRB)** digunakan untuk menempah bilik sindiket. Caranya sama seperti Meeting Room Booking — pilih slot, cari, dan sahkan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Syndicate Room Booking (SRB)** reserves syndicate rooms. On the Home page, open **Facility Booking Management** (under *Facilities & Support*) and choose **SRB**. It works the same way as Meeting Room Booking — pick a slot, search, confirm.",
                // 'ms' => "**Syndicate Room Booking (SRB)** digunakan untuk menempah bilik sindiket. Di Laman Utama, buka **Pengurusan Tempahan Kemudahan** (di bawah *Kemudahan & Sokongan*) dan pilih **SRB**. Caranya sama seperti Meeting Room Booking — pilih slot, cari, dan sahkan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Syndicate Room Booking (SRB)** reserves syndicate rooms. On the Home page, open **Facility Booking Management** (under *Facilities & Support*) and choose **SRB**. It works the same way as Meeting Room Booking — pick a slot, search, confirm.\n\nOne Stop Centre operators also have an **SRB** card on the **Admin** page.",
                // 'ms' => "**Syndicate Room Booking (SRB)** digunakan untuk menempah bilik sindiket. Di Laman Utama, buka **Pengurusan Tempahan Kemudahan** (di bawah *Kemudahan & Sokongan*) dan pilih **SRB**. Caranya sama seperti Meeting Room Booking — pilih slot, cari, dan sahkan.\n\nPengendali One Stop Centre juga mempunyai kad **SRB** di halaman **Admin**.",
                // #================================
                'en' => "**Syndicate Room Booking (SRB)** reserves syndicate rooms.\n\nOn the Home page, open **Facility Booking Management** (under *Facilities & Support*) and choose **SRB**. It works the same way as Meeting Room Booking — pick a slot, search, confirm.",
                'ms' => "**Syndicate Room Booking (SRB)** digunakan untuk menempah bilik sindiket.\n\nDi Laman Utama, buka **Pengurusan Tempahan Kemudahan** (di bawah *Kemudahan & Sokongan*) dan pilih **SRB**. Caranya sama seperti Meeting Room Booking — pilih slot, cari, dan sahkan.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // One Stop Centre operators have an SRB card on the Admin page (same page, bookings.booking.home)
            'admin'    => [
                'roles'  => ['ROLE_OSC_OP', 'ROLE_SUPERADMIN'],
                'answer' => [
                    'en' => "**Syndicate Room Booking (SRB)** reserves syndicate rooms.\n\nOpen **SRB** from the **Admin** or **Super Admin** page in the side menu to manage syndicate room bookings.",
                    'ms' => "**Syndicate Room Booking (SRB)** digunakan untuk menempah bilik sindiket.\n\nBuka **SRB** dari halaman **Admin** atau **Super Admin** di menu sisi untuk mengurus tempahan bilik sindiket.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'facility-admin',
            'title'    => [
                'en' => 'Facility Booking Management',
                'ms' => 'Facility Booking Management — pengurusan tempahan fasiliti',
            ],
            'category' => ['en' => 'Bookings', 'ms' => 'Tempahan'],
            'keywords' => [
                'facility booking', 'manage room', 'manage booking', 'room admin', 'booking admin',
                'add room', 'booking calendar', 'system calendar', 'approve booking',
                'urus tempahan', 'urus bilik', 'kalendar tempahan', 'luluskan tempahan',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_BOOKINGROOM_ADMIN'],
            // #================================
            // The Admin page's MRB card shows to these roles (admindashboard.blade.php)
            'roles'    => ['ROLE_BOOKINGROOM_ADMIN', 'ROLE_OSCROOM', 'ROLE_SUPERADMIN'],
            // #================================
            'url'      => 'adminbooking.rooms.index',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Facility Booking Management** is the administrator side of room bookings — manage the room list, review bookings, and view the full system calendar.",
                // 'ms' => "**Facility Booking Management** ialah bahagian pentadbir bagi tempahan bilik — urus senarai bilik, semak tempahan, dan lihat kalendar sistem sepenuhnya.",
                // #================================
                'en' => "**Room booking administration** — manage the room list, review bookings, and view the full system calendar.\n\nRoom booking administrators open **MRB** on the **Admin** page, which shows *Tempahan Bilik Mesyuarat* with four options: **Cari Ketersediaan Bilik**, **Kalendar**, **Tempahan** and **Bilik** (the room list).",
                'ms' => "**Pentadbiran tempahan bilik** — urus senarai bilik, semak tempahan, dan lihat kalendar sistem sepenuhnya.\n\nPentadbir tempahan bilik membuka **MRB** di halaman **Admin**, yang memaparkan *Tempahan Bilik Mesyuarat* dengan empat pilihan: **Cari Ketersediaan Bilik**, **Kalendar**, **Tempahan** dan **Bilik** (senarai bilik).",
                // #================================
            ],
        ],

        /* ---------------------------------------------------------------
         | Human resources
         * --------------------------------------------------------------- */

        [
            'id'       => 'hrs',
            'title'    => [
                'en' => 'Human Resource System (HRS)',
                'ms' => 'Human Resource System (HRS) — sistem sumber manusia',
            ],
            'category' => ['en' => 'Human resources', 'ms' => 'Sumber manusia'],
            'keywords' => [
                'hrs', 'human resource', 'hr system', 'hr', 'staff record', 'personnel',
                'jawatan', 'pemegang jawatan', 'position', 'post', 'perjawatan', 'kakitangan',
                'rekod kakitangan', 'sumber manusia',
                // #========== NEWLY ADDED ============
                'hrids',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_HRIDS', 'ROLE_HRIDS_NONTEACHING', 'ROLE_PERJAWATAN'],
            // 'url'      => '/servicesdashboard',
            // #================================
            // HRIDS card on the Admin page (ROLE_SUPERADMIN|ROLE_HRIDS|ROLE_HRIDS_NONTEACHING) -> pj.landingpage.
            // ROLE_PERJAWATAN has its own card (see 'post-establishment')
            'roles'    => ['ROLE_HRIDS', 'ROLE_HRIDS_NONTEACHING', 'ROLE_SUPERADMIN'],
            'url'      => 'pj.landingpage',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Human Resource System (HRS)** holds staff records, positions (*jawatan*) and position holders (*pemegang jawatan*).\n\nIf a record is wrong, HRS is not the place to fix it yourself — raise it with your department HR administrator.",
                // 'ms' => "**Human Resource System (HRS)** menyimpan rekod kakitangan, jawatan dan pemegang jawatan.\n\nJika sesuatu rekod tidak tepat, anda tidak boleh membetulkannya sendiri di HRS — kemukakan kepada pentadbir HR jabatan anda.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Human Resource System (HRS)** holds staff records, positions (*jawatan*) and position holders (*pemegang jawatan*).\n\nHR officers with the HRIDS role open it from the **HRIDS** card on the **Admin** page.\n\nIf your own record is wrong, raise it with your department HR administrator.",
                // 'ms' => "**Human Resource System (HRS)** menyimpan rekod kakitangan, jawatan dan pemegang jawatan.\n\nPegawai HR yang mempunyai peranan HRIDS membukanya melalui kad **HRIDS** di halaman **Admin**.\n\nJika rekod anda sendiri tidak tepat, kemukakan kepada pentadbir HR jabatan anda.",
                // #================================
                'en' => "**Human Resource System (HRS)** holds staff records, positions (*jawatan*) and position holders (*pemegang jawatan*).\n\nOpen it from the **HRIDS** card on the **Admin** or **Super Admin** page.",
                'ms' => "**Human Resource System (HRS)** menyimpan rekod kakitangan, jawatan dan pemegang jawatan.\n\nBuka melalui kad **HRIDS** di halaman **Admin** atau **Super Admin**.",
                // #================================
                // #================================
            ],
        ],
        // #========== NEWLY ADDED ============
        [
            'id'       => 'post-establishment',
            'title'    => [
                'en' => 'Post Establishment Management (Perjawatan)',
                'ms' => 'Pengurusan Perjawatan',
            ],
            'category' => ['en' => 'Human resources', 'ms' => 'Sumber manusia'],
            'keywords' => [
                'post establishment', 'perjawatan', 'establishment', 'jawatan', 'posts',
                'pengurusan perjawatan', 'senarai jawatan',
            ],
            'roles'    => ['ROLE_PERJAWATAN', 'ROLE_SUPERADMIN'],
            'url'      => 'perjawatan.perjawatan.index',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Post Establishment Management** (*perjawatan*) manages the ministry's posts. Officers with the Perjawatan role open it from the **Post Establishment Management** card on the **Admin** page.",
                // 'ms' => "**Pengurusan Perjawatan** menguruskan jawatan-jawatan kementerian. Pegawai yang mempunyai peranan Perjawatan membukanya melalui kad **Post Establishment Management** di halaman **Admin**.",
                // #================================
                'en' => "**Post Establishment Management** (*perjawatan*) manages the ministry's posts.\n\nOpen it from the **Post Establishment Management** card on the **Admin** or **Super Admin** page.",
                'ms' => "**Pengurusan Perjawatan** menguruskan jawatan-jawatan kementerian.\n\nBuka melalui kad **Post Establishment Management** di halaman **Admin** atau **Super Admin**.",
                // #================================
            ],
        ],
        // #================================
        [
            'id'       => 'baki-cuti',
            'title'    => [
                'en' => 'Baki Cuti — leave balance',
                'ms' => 'Baki Cuti',
            ],
            'category' => ['en' => 'Human resources', 'ms' => 'Sumber manusia'],
            'keywords' => [
                'baki cuti', 'leave balance', 'remaining leave', 'how many days leave',
                'annual leave', 'leave left', 'cuti', 'baki', 'balance cuti', 'my leave',
                'baki cuti saya', 'cuti tahunan', 'berapa hari cuti',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_BAKI_CUTI'],
            // #================================
            // bakicuti.bakicutis.index (own balance) has no role check; ROLE_BAKI_CUTI / ROLE_PDMS_CUTI get the admin list
            // #================================
            'url'      => 'bakicuti.bakicutis.index',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Baki Cuti** shows your remaining leave balance.\n\nIf the number looks wrong, check with your department HR administrator — the bot cannot see or correct leave records.",
                // 'ms' => "**Baki Cuti** memaparkan baki cuti anda yang masih ada.\n\nJika angkanya kelihatan tidak tepat, semak dengan pentadbir HR jabatan anda — saya tidak dapat melihat atau membetulkan rekod cuti.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Baki Cuti** shows your remaining leave balance.\n\n- **Staff:** use the link below to see your own balance.\n- **Leave administrators:** on the **Admin** page, open **My SSM** → **Information** → **Baki Cuti** to see and manage everyone's balance.\n\nIf the number looks wrong, check with your department HR administrator — the bot cannot see or correct leave records.",
                // 'ms' => "**Baki Cuti** memaparkan baki cuti anda yang masih ada.\n\n- **Kakitangan:** gunakan pautan di bawah untuk melihat baki cuti anda sendiri.\n- **Pentadbir cuti:** di halaman **Admin**, buka **My SSM** → **Information** → **Baki Cuti** untuk melihat dan mengurus baki cuti semua kakitangan.\n\nJika angkanya kelihatan tidak tepat, semak dengan pentadbir HR jabatan anda — saya tidak dapat melihat atau membetulkan rekod cuti.",
                // #================================
                'en' => "**Baki Cuti** shows your remaining leave balance. Use the link below to see it.\n\nIf the number looks wrong, check with your department HR administrator — the bot cannot see or correct leave records.",
                'ms' => "**Baki Cuti** memaparkan baki cuti anda yang masih ada. Gunakan pautan di bawah untuk melihatnya.\n\nJika angkanya kelihatan tidak tepat, semak dengan pentadbir HR jabatan anda — saya tidak dapat melihat atau membetulkan rekod cuti.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin page -> My SSM -> Information -> Baki Cuti (bakicuti.bakicutis.indexadmin)
            'admin'    => [
                'roles'  => ['ROLE_BAKI_CUTI', 'ROLE_PDMS_CUTI', 'ROLE_SUPERADMIN'],
                'url'    => 'bakicuti.bakicutis.indexadmin',
                'answer' => [
                    'en' => "**Baki Cuti** holds the leave balance of every staff member.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page, then choose **Information** → **Baki Cuti** to see and manage the balances.",
                    'ms' => "**Baki Cuti** menyimpan baki cuti setiap kakitangan.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin**, kemudian pilih **Information** → **Baki Cuti** untuk melihat dan mengurus baki cuti.",
                ],
            ],
            // #================================
        ],
        // #========== NEWLY ADDED ============
        [
            'id'       => 'leave',
            'title'    => [
                'en' => 'Leave (Cuti)',
                'ms' => 'Cuti',
            ],
            'category' => ['en' => 'Human resources', 'ms' => 'Sumber manusia'],
            'keywords' => [
                'leave', 'apply leave', 'leave application', 'leave record', 'cuti',
                'mohon cuti', 'permohonan cuti', 'rekod cuti',
            ],
            // #============= ORI CODE ==============
            // // cutis.cuti.index: checkRole:ROLE_SUPERADMIN|ROLE_CUTI
            // 'roles'    => ['ROLE_CUTI', 'ROLE_SUPERADMIN'],
            // 'url'      => 'cutis.cuti.index',
            // 'answer'   => [
            //     'en' => "**Cuti** (leave) records are handled by officers with the leave role. They open it from the **Admin** page → **My SSM** → **Information** → **Cuti**.\n\nFor other staff, **Leave** in the **My SSM** popup on the Home page is still marked *Coming Soon*. To check your remaining days, ask me about **Baki Cuti**.",
            //     'ms' => "Rekod **Cuti** dikendalikan oleh pegawai yang mempunyai peranan cuti. Mereka membukanya dari halaman **Admin** → **My SSM** → **Information** → **Cuti**.\n\nBagi kakitangan lain, **Cuti** dalam tetingkap **My SSM** di Laman Utama masih ditanda *Akan Datang*. Untuk menyemak baki hari cuti anda, tanya saya tentang **Baki Cuti**.",
            // ],
            // #================================
            // Normal users: Coming Soon, no link. Leave officers (cutis.cuti.index: checkRole ROLE_SUPERADMIN|ROLE_CUTI) get 'admin'.
            'answer'   => [
                'en' => "**Leave** in the **My SSM** card on the Home page is still marked *Coming Soon*.\n\nTo check your remaining days, ask me about **Baki Cuti**.",
                'ms' => "**Cuti** dalam kad **My SSM** di Laman Utama masih ditanda *Akan Datang*.\n\nUntuk menyemak baki hari cuti anda, tanya saya tentang **Baki Cuti**.",
            ],
            'admin'    => [
                'roles'  => ['ROLE_CUTI', 'ROLE_SUPERADMIN'],
                'url'    => 'cutis.cuti.index',
                'answer' => [
                    'en' => "**Cuti** holds staff leave records.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page, then choose **Information** → **Cuti**.",
                    'ms' => "**Cuti** menyimpan rekod cuti kakitangan.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin**, kemudian pilih **Information** → **Cuti**.",
                ],
            ],
            // #================================
        ],
        // #================================
        [
            'id'       => 'acting',
            'title'    => [
                'en' => 'Acting appointments',
                'ms' => 'Acting — pelantikan memangku',
            ],
            'category' => ['en' => 'Human resources', 'ms' => 'Sumber manusia'],
            'keywords' => [
                'acting', 'act', 'acting appointment', 'memangku', 'pemangku', 'temporary post',
                'pelantikan memangku',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_ACT'],
            // 'url'      => '/servicesdashboard',
            // #================================
            // #============= ORI CODE ==============
            // // actings.acting.index: checkRole:ROLE_SUPERADMIN|ROLE_ACT
            // 'roles'    => ['ROLE_ACT', 'ROLE_SUPERADMIN'],
            // 'url'      => 'actings.acting.index',
            // #================================
            // Moved into 'admin' below; normal users see Coming Soon with no link
            // #================================
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Acting** records acting appointments — who is covering which post and for how long.",
                // 'ms' => "**Acting** merekodkan pelantikan memangku — siapa yang memangku jawatan mana dan untuk tempoh berapa lama.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Acting** records acting appointments — who is covering which post and for how long.\n\nFor most staff, **Acting** in the **My SSM** popup on the Home page is still marked *Coming Soon*; only officers with the Acting role can use it now.",
                // 'ms' => "**Acting** merekodkan pelantikan memangku — siapa yang memangku jawatan mana dan untuk tempoh berapa lama.\n\nBagi kebanyakan kakitangan, **Memangku** dalam tetingkap **My SSM** di Laman Utama masih ditanda *Akan Datang*; hanya pegawai yang mempunyai peranan Acting boleh menggunakannya sekarang.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Acting** records acting appointments — who is covering which post and for how long.\n\n- **Officers with the Acting role:** **Admin** page → **My SSM** → **Information** → **Memangku**.\n- **Other staff:** **Acting** in the **My SSM** popup on the Home page is still marked *Coming Soon*.",
                // 'ms' => "**Acting** merekodkan pelantikan memangku — siapa yang memangku jawatan mana dan untuk tempoh berapa lama.\n\n- **Pegawai yang mempunyai peranan Acting:** halaman **Admin** → **My SSM** → **Information** → **Memangku**.\n- **Kakitangan lain:** **Memangku** dalam tetingkap **My SSM** di Laman Utama masih ditanda *Akan Datang*.",
                // #================================
                'en' => "**Acting** records acting appointments — who is covering which post and for how long.\n\n**Acting** in the **My SSM** card on the Home page is still marked *Coming Soon*.",
                'ms' => "**Acting** merekodkan pelantikan memangku — siapa yang memangku jawatan mana dan untuk tempoh berapa lama.\n\n**Memangku** dalam kad **My SSM** di Laman Utama masih ditanda *Akan Datang*.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            'admin'    => [
                'roles'  => ['ROLE_ACT', 'ROLE_SUPERADMIN'],
                'url'    => 'actings.acting.index',
                'answer' => [
                    'en' => "**Acting** records acting appointments — who is covering which post and for how long.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page, then choose **Information** → **Memangku**.",
                    'ms' => "**Acting** merekodkan pelantikan memangku — siapa yang memangku jawatan mana dan untuk tempoh berapa lama.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin**, kemudian pilih **Information** → **Memangku**.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'retirement',
            'title'    => [
                'en' => 'Retirement (Bersara)',
                'ms' => 'Persaraan (Bersara)',
            ],
            'category' => ['en' => 'Human resources', 'ms' => 'Sumber manusia'],
            'keywords' => [
                'retirement', 'retire', 'bersara', 'persaraan', 'pension', 'pencen',
                'tarikh bersara',
            ],
            // #============= ORI CODE ==============
            // // #========== NEWLY ADDED ============
            // // Retirement routes are restricted (checkRole:ROLE_SUPERADMIN|ROLE_BERSARA)
            // 'roles'    => ['ROLE_BERSARA', 'ROLE_SUPERADMIN'],
            // // #================================
            // // #============= ORI CODE ==============
            // // 'url'      => '/servicesdashboard',
            // // #================================
            // 'url'      => 'bersaras.bersara.index',
            // // #================================
            // #================================
            // Moved into 'admin' below; normal users see Coming Soon with no link
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Retirement (Bersara)** handles retirement records and processing.\n\nFor questions about your own retirement date or entitlement, speak to your department HR administrator.",
                // 'ms' => "**Bersara** menguruskan rekod dan proses persaraan.\n\nUntuk pertanyaan tentang tarikh persaraan atau kelayakan anda sendiri, sila hubungi pentadbir HR jabatan anda.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Retirement (Bersara)** handles retirement records and processing.\n\nFor most staff, **Retirement** in the **My SSM** popup on the Home page is still marked *Coming Soon*. For questions about your own retirement date or entitlement, speak to your department HR administrator.",
                // 'ms' => "**Bersara** menguruskan rekod dan proses persaraan.\n\nBagi kebanyakan kakitangan, **Bersara** dalam tetingkap **My SSM** di Laman Utama masih ditanda *Akan Datang*. Untuk pertanyaan tentang tarikh persaraan atau kelayakan anda sendiri, sila hubungi pentadbir HR jabatan anda.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Retirement (Bersara)** handles retirement records and processing.\n\n- **Officers with the Bersara role:** **Admin** page → **My SSM** → **Information** → **Bersara**.\n- **Other staff:** **Retirement** in the **My SSM** popup on the Home page is still marked *Coming Soon*. For questions about your own retirement date or entitlement, speak to your department HR administrator.",
                // 'ms' => "**Bersara** menguruskan rekod dan proses persaraan.\n\n- **Pegawai yang mempunyai peranan Bersara:** halaman **Admin** → **My SSM** → **Information** → **Bersara**.\n- **Kakitangan lain:** **Bersara** dalam tetingkap **My SSM** di Laman Utama masih ditanda *Akan Datang*. Untuk pertanyaan tentang tarikh persaraan atau kelayakan anda sendiri, sila hubungi pentadbir HR jabatan anda.",
                // #================================
                'en' => "**Retirement (Bersara)** handles retirement records and processing.\n\n**Retirement** in the **My SSM** card on the Home page is still marked *Coming Soon*. For questions about your own retirement date or entitlement, speak to your department HR administrator.",
                'ms' => "**Bersara** menguruskan rekod dan proses persaraan.\n\n**Bersara** dalam kad **My SSM** di Laman Utama masih ditanda *Akan Datang*. Untuk pertanyaan tentang tarikh persaraan atau kelayakan anda sendiri, sila hubungi pentadbir HR jabatan anda.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            'admin'    => [
                'roles'  => ['ROLE_BERSARA', 'ROLE_SUPERADMIN'],
                'url'    => 'bersaras.bersara.index',
                'answer' => [
                    'en' => "**Retirement (Bersara)** handles retirement records and processing.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page, then choose **Information** → **Bersara**.",
                    'ms' => "**Bersara** menguruskan rekod dan proses persaraan.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin**, kemudian pilih **Information** → **Bersara**.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'performance',
            'title'    => [
                'en' => 'Performance and Medal',
                'ms' => 'Prestasi dan Pingat',
            ],
            'category' => ['en' => 'Human resources', 'ms' => 'Sumber manusia'],
            'keywords' => [
                'performance', 'prestasi', 'appraisal', 'medal', 'pingat', 'award', 'anugerah',
                'usdi', 'penilaian prestasi',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_PRESTASI'],
            // 'url'      => '/services',
            // #================================
            // prestasi.prestasi.indexadmin: checkRole:ROLE_SUPERADMIN|ROLE_PRESTASI (Admin page -> My SSM -> Prestasi)
            'roles'    => ['ROLE_PRESTASI', 'ROLE_SUPERADMIN'],
            'url'      => 'prestasi.prestasi.indexadmin',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Performance** (*prestasi*) holds service performance records, and **Medal** (*pingat*) holds medal and award records. Both sit under the Services page.",
                // 'ms' => "**Prestasi** menyimpan rekod prestasi perkhidmatan, manakala **Pingat** menyimpan rekod pingat dan anugerah. Kedua-duanya berada di bawah halaman Perkhidmatan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Performance** (*prestasi*) holds service performance records, and **Medal** (*pingat*) holds medal and award records.\n\nOfficers with the Prestasi role open it from the **Admin** page → **My SSM** → **Prestasi**.",
                // 'ms' => "**Prestasi** menyimpan rekod prestasi perkhidmatan, manakala **Pingat** menyimpan rekod pingat dan anugerah.\n\nPegawai yang mempunyai peranan Prestasi membukanya dari halaman **Admin** → **My SSM** → **Prestasi**.",
                // #================================
                'en' => "**Performance** (*prestasi*) holds service performance records, and **Medal** (*pingat*) holds medal and award records.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page and choose **Prestasi**.",
                'ms' => "**Prestasi** menyimpan rekod prestasi perkhidmatan, manakala **Pingat** menyimpan rekod pingat dan anugerah.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin** dan pilih **Prestasi**.",
                // #================================
                // #================================
            ],
        ],

        /* ---------------------------------------------------------------
         | SSM
         * --------------------------------------------------------------- */

        [
            'id'       => 'my-ssm',
            'title'    => [
                'en' => 'My SSM',
                'ms' => 'My SSM',
            ],
            'category' => ['en' => 'SSM', 'ms' => 'SSM'],
            'keywords' => [
                'my ssm', 'ssm', 'sistem sumber manusia', 'ssm record', 'my record',
                'service record', 'rekod perkhidmatan', 'rekod ssm',
                // #========== NEWLY ADDED ============
                'ssm admin', 'ssm application', 'permohonan ssm', 'ssm request admin',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_SSM'],
            // #================================
            // My SSM is on everyone's Home page and ssms.ssm.index has no role check, so no roles here
            // #================================
            'url'      => 'ssms.ssm.index',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**My SSM** is your own record in *Sistem Sumber Manusia* — service history, personal particulars, and related documents.",
                // 'ms' => "**My SSM** ialah rekod anda sendiri dalam *Sistem Sumber Manusia* — sejarah perkhidmatan, butiran peribadi, dan dokumen berkaitan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**My SSM** is your own record in *Sistem Sumber Manusia* — service history, personal particulars, and related documents.\n\nOn the Home page, open the **My SSM** card (under *Human Resource*). It offers:\n\n- **Activate SSM Account**\n- **SSM Enquiries**\n- **Leave**, **Acting** and **Retirement** — still *Coming Soon*.",
                // 'ms' => "**My SSM** ialah rekod anda sendiri dalam *Sistem Sumber Manusia* — sejarah perkhidmatan, butiran peribadi, dan dokumen berkaitan.\n\nDi Laman Utama, buka kad **My SSM** (di bawah *Sumber Manusia*). Ia menawarkan:\n\n- **Aktifkan Akaun SSM**\n- **Pertanyaan SSM**\n- **Cuti**, **Memangku** dan **Bersara** — masih *Akan Datang*.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**My SSM** is your record in *Sistem Sumber Manusia* — service history, personal particulars, and related documents.\n\n**Staff** — Home page → **My SSM** card (under *Human Resource*):\n\n- **Activate SSM Account**\n- **SSM Enquiries**\n- **Leave**, **Acting** and **Retirement** — still *Coming Soon*.\n\n**SSM and HR administrators** — **Admin** page → **My SSM** shows more, depending on your role:\n\n- **Activate SSM Account** — all accounts\n- **SSM Request Admin** — handle staff enquiries\n- **SSM Application** — applications waiting for action\n- **Information** — Cuti, Memangku, Bersara and Baki Cuti\n- **Prestasi**",
                // 'ms' => "**My SSM** ialah rekod anda dalam *Sistem Sumber Manusia* — sejarah perkhidmatan, butiran peribadi, dan dokumen berkaitan.\n\n**Kakitangan** — Laman Utama → kad **My SSM** (di bawah *Sumber Manusia*):\n\n- **Aktifkan Akaun SSM**\n- **Pertanyaan SSM**\n- **Cuti**, **Memangku** dan **Bersara** — masih *Akan Datang*.\n\n**Pentadbir SSM dan HR** — halaman **Admin** → **My SSM** memaparkan lebih banyak pilihan, bergantung kepada peranan anda:\n\n- **Activate SSM Account** — semua akaun\n- **SSM Request Admin** — mengendalikan pertanyaan kakitangan\n- **SSM Application** — permohonan yang menunggu tindakan\n- **Information** — Cuti, Memangku, Bersara dan Baki Cuti\n- **Prestasi**",
                // #================================
                'en' => "**My SSM** is your record in *Sistem Sumber Manusia* — service history, personal particulars, and related documents.\n\nOpen the **My SSM** card on the Home page (under *Human Resource*). It offers **Activate SSM Account** and **SSM Enquiries**; **Leave**, **Acting** and **Retirement** are still *Coming Soon*.",
                'ms' => "**My SSM** ialah rekod anda dalam *Sistem Sumber Manusia* — sejarah perkhidmatan, butiran peribadi, dan dokumen berkaitan.\n\nBuka kad **My SSM** di Laman Utama (di bawah *Sumber Manusia*). Ia menawarkan **Aktifkan Akaun SSM** dan **Pertanyaan SSM**; **Cuti**, **Memangku** dan **Bersara** masih *Akan Datang*.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin page -> My SSM popup (admindashboard.blade.php); options shown depend on the role
            'admin'    => [
                'roles'  => ['ROLE_SSM', 'ROLE_ACT', 'ROLE_BAKI_CUTI', 'ROLE_PDMS_CUTI', 'ROLE_PRESTASI', 'ROLE_SUPERADMIN'],
                'answer' => [
                    'en' => "**My SSM** holds staff records in *Sistem Sumber Manusia* — service history, personal particulars, and related documents.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page. Depending on your access it offers **Activate SSM Account**, **SSM Request Admin**, **SSM Application**, **Information** (Cuti, Memangku, Bersara and Baki Cuti) and **Prestasi**.",
                    'ms' => "**My SSM** menyimpan rekod kakitangan dalam *Sistem Sumber Manusia* — sejarah perkhidmatan, butiran peribadi, dan dokumen berkaitan.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin**. Bergantung kepada akses anda, ia menawarkan **Activate SSM Account**, **SSM Request Admin**, **SSM Application**, **Information** (Cuti, Memangku, Bersara dan Baki Cuti) dan **Prestasi**.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'ssm-enquiry',
            'title'    => [
                'en' => 'SSM Enquiries',
                'ms' => 'SSM Enquiries — aduan dan pertanyaan SSM',
            ],
            'category' => ['en' => 'SSM', 'ms' => 'SSM'],
            'keywords' => [
                'ssm enquiry', 'ssm enquiries', 'ssm complaint', 'aduan ssm', 'aduan',
                'ssm problem', 'ssm wrong', 'ssm error', 'complaint', 'pertanyaan ssm',
                'rekod ssm salah',
                // #========== NEWLY ADDED ============
                'borang aduan ssm', 'status aduan', 'reference number', 'no rujukan', 'status rujukan',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_ADUANSSM'],
            // 'url'      => '/servicesdashboard',
            // #================================
            // The enquiry form (/borangaduanssm) is open to all; ROLE_ADUANSSM is the admin side that handles them
            'url'      => '/borangaduanssm',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**SSM Enquiries** is where you raise a query or complaint about your SSM record — wrong particulars, missing service history, and so on.",
                // 'ms' => "**SSM Enquiries** ialah tempat anda mengemukakan pertanyaan atau aduan tentang rekod SSM anda — butiran yang salah, sejarah perkhidmatan yang tertinggal, dan sebagainya.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**SSM Enquiries** is where you raise a query or complaint about your SSM record — wrong particulars, missing service history, and so on.\n\nOn the Home page, open **My SSM** and choose **SSM Enquiries**. Keep the reference number you are given — you can use it later to check the status of your enquiry.",
                // 'ms' => "**SSM Enquiries** ialah tempat anda mengemukakan pertanyaan atau aduan tentang rekod SSM anda — butiran yang salah, sejarah perkhidmatan yang tertinggal, dan sebagainya.\n\nDi Laman Utama, buka **My SSM** dan pilih **Pertanyaan SSM**. Simpan nombor rujukan yang diberikan — anda boleh menggunakannya kemudian untuk menyemak status pertanyaan anda.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**SSM Enquiries** is where you raise a query or complaint about your SSM record — wrong particulars, missing service history, and so on.\n\n- **Staff:** Home page → **My SSM** → **SSM Enquiries**. Keep the reference number you are given — you can use it later to check the status of your enquiry.\n- **SSM administrators:** **Admin** page → **My SSM** → **SSM Request Admin** to see and answer the enquiries.",
                // 'ms' => "**SSM Enquiries** ialah tempat anda mengemukakan pertanyaan atau aduan tentang rekod SSM anda — butiran yang salah, sejarah perkhidmatan yang tertinggal, dan sebagainya.\n\n- **Kakitangan:** Laman Utama → **My SSM** → **Pertanyaan SSM**. Simpan nombor rujukan yang diberikan — anda boleh menggunakannya kemudian untuk menyemak status pertanyaan anda.\n- **Pentadbir SSM:** halaman **Admin** → **My SSM** → **SSM Request Admin** untuk melihat dan menjawab pertanyaan.",
                // #================================
                'en' => "**SSM Enquiries** is where you raise a query or complaint about your SSM record — wrong particulars, missing service history, and so on.\n\nOn the Home page, open **My SSM** and choose **SSM Enquiries**. Keep the reference number you are given — you can use it later to check the status of your enquiry.",
                'ms' => "**SSM Enquiries** ialah tempat anda mengemukakan pertanyaan atau aduan tentang rekod SSM anda — butiran yang salah, sejarah perkhidmatan yang tertinggal, dan sebagainya.\n\nDi Laman Utama, buka **My SSM** dan pilih **Pertanyaan SSM**. Simpan nombor rujukan yang diberikan — anda boleh menggunakannya kemudian untuk menyemak status pertanyaan anda.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin page -> My SSM -> SSM Request Admin (ssmrequests.ssmrequest.indexall)
            'admin'    => [
                'roles'  => ['ROLE_SSM', 'ROLE_ADUANSSM', 'ROLE_SUPERADMIN'],
                'url'    => 'ssmrequests.ssmrequest.indexall',
                'answer' => [
                    'en' => "**SSM Enquiries** are the queries and complaints staff raise about their SSM records.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page and choose **SSM Request Admin** to see and answer them.",
                    'ms' => "**SSM Enquiries** ialah pertanyaan dan aduan yang dikemukakan kakitangan tentang rekod SSM mereka.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin** dan pilih **SSM Request Admin** untuk melihat dan menjawabnya.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'ssm-activate',
            'title'    => [
                'en' => 'Activate SSM Account',
                'ms' => 'Activate SSM Account — mengaktifkan akaun SSM',
            ],
            'category' => ['en' => 'SSM', 'ms' => 'SSM'],
            'keywords' => [
                'activate ssm', 'ssm account', 'ssm activation', 'first time ssm',
                'ssm login', 'cannot login ssm', 'aktifkan ssm', 'akaun ssm',
            ],
            // #============= ORI CODE ==============
            // 'url'      => '/servicesdashboard',
            // #================================
            'url'      => 'ssms.ssm.index',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Activate SSM Account** is the one-time activation for a new SSM account. Run it once, then use **My SSM** from then on.",
                // 'ms' => "**Activate SSM Account** ialah pengaktifan sekali sahaja untuk akaun SSM baharu. Lakukan sekali, kemudian gunakan **My SSM** selepas itu.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Activate SSM Account** is the one-time activation for a new SSM account. On the Home page, open **My SSM** and choose **Activate SSM Account**. Run it once, then use **My SSM** from then on.",
                // 'ms' => "**Activate SSM Account** ialah pengaktifan sekali sahaja untuk akaun SSM baharu. Di Laman Utama, buka **My SSM** dan pilih **Aktifkan Akaun SSM**. Lakukan sekali, kemudian gunakan **My SSM** selepas itu.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Activate SSM Account** is the one-time activation for a new SSM account.\n\n- **Staff:** Home page → **My SSM** → **Activate SSM Account**. Run it once, then use **My SSM** from then on.\n- **SSM administrators:** **Admin** page → **My SSM** → **Activate SSM Account** lists every account.",
                // 'ms' => "**Activate SSM Account** ialah pengaktifan sekali sahaja untuk akaun SSM baharu.\n\n- **Kakitangan:** Laman Utama → **My SSM** → **Aktifkan Akaun SSM**. Lakukan sekali, kemudian gunakan **My SSM** selepas itu.\n- **Pentadbir SSM:** halaman **Admin** → **My SSM** → **Activate SSM Account** menyenaraikan semua akaun.",
                // #================================
                'en' => "**Activate SSM Account** is the one-time activation for a new SSM account.\n\nOn the Home page, open **My SSM** and choose **Activate SSM Account**. Run it once, then use **My SSM** from then on.",
                'ms' => "**Activate SSM Account** ialah pengaktifan sekali sahaja untuk akaun SSM baharu.\n\nDi Laman Utama, buka **My SSM** dan pilih **Aktifkan Akaun SSM**. Lakukan sekali, kemudian gunakan **My SSM** selepas itu.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin page -> My SSM -> Activate SSM Account (ssms.ssm.indexall)
            'admin'    => [
                'roles'  => ['ROLE_SSM', 'ROLE_SUPERADMIN'],
                'url'    => 'ssms.ssm.indexall',
                'answer' => [
                    'en' => "**Activate SSM Account** lists every SSM account and its activation.\n\nOpen **My SSM** from the **Admin** or **Super Admin** page and choose **Activate SSM Account**.",
                    'ms' => "**Activate SSM Account** menyenaraikan setiap akaun SSM dan pengaktifannya.\n\nBuka **My SSM** dari halaman **Admin** atau **Super Admin** dan pilih **Activate SSM Account**.",
                ],
            ],
            // #================================
        ],

        /* ---------------------------------------------------------------
         | Claims
         * --------------------------------------------------------------- */

        [
            'id'       => 'mileage',
            'title'    => [
                'en' => 'Mileage claims',
                'ms' => 'Mileage — tuntutan perjalanan',
            ],
            'category' => ['en' => 'Claims', 'ms' => 'Tuntutan'],
            'keywords' => [
                'mileage', 'claim', 'claims', 'travel claim', 'tuntutan', 'petrol',
                'transport claim', 'apply claim', 'claim history', 'reimbursement',
                'tuntutan perjalanan', 'mohon tuntutan', 'sejarah tuntutan',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_CLAIMANT', 'ROLE_HOD', 'ROLE_MAW', 'ROLE_DA', 'ROLE_ENDORSER', 'ROLE_MAW_SECOND', 'ROLE_MAW_ENDORSER'],
            // #================================
            // The bot matches roles exactly, so super admins must be listed or they are told they have no access
            'roles'    => ['ROLE_CLAIMANT', 'ROLE_HOD', 'ROLE_MAW', 'ROLE_DA', 'ROLE_ENDORSER', 'ROLE_MAW_SECOND', 'ROLE_MAW_ENDORSER', 'ROLE_SUPERADMIN'],
            // #================================
            'url'      => '/services',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Mileage** handles travel claims. From the Services page:\n\n- **Apply** — submit a new claim.\n- **History** — see your past claims and where each one sits.\n\nApprovers (HOD, MAW, DA, endorsers) see submitted claims waiting for their sign-off in the same place.",
                // 'ms' => "**Mileage** menguruskan tuntutan perjalanan. Dari halaman Perkhidmatan:\n\n- **Apply** — hantar tuntutan baharu.\n- **History** — lihat tuntutan lepas anda dan status setiap satu.\n\nPegawai yang meluluskan (HOD, MAW, DA, penyokong) melihat tuntutan yang menunggu kelulusan mereka di tempat yang sama.",
                // #================================
                'en' => "**Mileage** handles travel claims. From the Services page:\n\n- **Apply** — submit a new claim.\n- **History** — see your past claims and where each one sits.",
                'ms' => "**Mileage** menguruskan tuntutan perjalanan. Dari halaman Perkhidmatan:\n\n- **Apply** — hantar tuntutan baharu.\n- **History** — lihat tuntutan lepas anda dan status setiap satu.",
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Approvers get the sign-off wording instead
            'admin'    => [
                'roles'  => ['ROLE_HOD', 'ROLE_MAW', 'ROLE_DA', 'ROLE_ENDORSER', 'ROLE_MAW_SECOND', 'ROLE_MAW_ENDORSER'],
                'answer' => [
                    'en' => "**Mileage** handles travel claims.\n\nOn the Services page, the claims waiting for your sign-off are listed for you to review and approve. **Apply** and **History** are there for your own claims.",
                    'ms' => "**Mileage** menguruskan tuntutan perjalanan.\n\nDi halaman Perkhidmatan, tuntutan yang menunggu kelulusan anda disenaraikan untuk disemak dan diluluskan. **Apply** dan **History** ada di situ untuk tuntutan anda sendiri.",
                ],
            ],
            // #================================
        ],

        /* ---------------------------------------------------------------
         | Curriculum and co-curriculum
         * --------------------------------------------------------------- */

        [
            'id'       => 'ccam',
            'title'    => [
                'en' => 'Co-Curriculum Activities Management (CCAM)',
                'ms' => 'Co-Curriculum Activities Management (CCAM) — pengurusan kokurikulum',
            ],
            'category' => ['en' => 'Curriculum', 'ms' => 'Kurikulum'],
            'keywords' => [
                'ccam', 'cca', 'co-curriculum', 'cocurriculum', 'co curriculum', 'club',
                'kelab', 'uniformed body', 'pasukan beruniform', 'activities', 'aktiviti',
                'kokurikulum',
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_CCA_ADMIN', 'ROLE_CCA_FOCAL'],
            // #================================
            // cca.cca.index (Home card) has no role check; ROLE_CCA_ADMIN / ROLE_CCA_FOCAL get cca.cca.indexAll on the Admin page
            // #================================
            'url'      => 'cca.cca.index',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Co-Curriculum Activities Management (CCAM)** manages clubs, uniformed bodies and co-curricular activities, including membership lists and activity records.",
                // 'ms' => "**Co-Curriculum Activities Management (CCAM)** menguruskan kelab, pasukan beruniform dan aktiviti kokurikulum, termasuk senarai keahlian dan rekod aktiviti.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Co-Curriculum Activities Management (CCAM)** manages clubs, uniformed bodies and co-curricular activities, including membership lists and activity records.\n\n- **Staff:** open the **CCAM** card on the Home page (under *Operations*).\n- **CCA administrators and focal points:** open **CCAM** on the **Admin** page to see the records of all schools.",
                // 'ms' => "**Co-Curriculum Activities Management (CCAM)** menguruskan kelab, pasukan beruniform dan aktiviti kokurikulum, termasuk senarai keahlian dan rekod aktiviti.\n\n- **Kakitangan:** buka kad **CCAM** di Laman Utama (di bawah *Operasi*).\n- **Pentadbir dan pegawai fokal CCA:** buka **CCAM** di halaman **Admin** untuk melihat rekod semua sekolah.",
                // #================================
                'en' => "**Co-Curriculum Activities Management (CCAM)** manages clubs, uniformed bodies and co-curricular activities, including membership lists and activity records.\n\nOpen it from the **CCAM** card on the Home page (under *Operations*).",
                'ms' => "**Co-Curriculum Activities Management (CCAM)** menguruskan kelab, pasukan beruniform dan aktiviti kokurikulum, termasuk senarai keahlian dan rekod aktiviti.\n\nBuka melalui kad **CCAM** di Laman Utama (di bawah *Operasi*).",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin page -> CCAM (cca.cca.indexAll)
            'admin'    => [
                'roles'  => ['ROLE_CCA_ADMIN', 'ROLE_CCA_FOCAL', 'ROLE_SUPERADMIN'],
                'url'    => 'cca.cca.indexAll',
                'answer' => [
                    'en' => "**Co-Curriculum Activities Management (CCAM)** manages clubs, uniformed bodies and co-curricular activities, including membership lists and activity records.\n\nOpen **CCAM** from the **Admin** or **Super Admin** page to see the records of all schools.",
                    'ms' => "**Co-Curriculum Activities Management (CCAM)** menguruskan kelab, pasukan beruniform dan aktiviti kokurikulum, termasuk senarai keahlian dan rekod aktiviti.\n\nBuka **CCAM** dari halaman **Admin** atau **Super Admin** untuk melihat rekod semua sekolah.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'cms',
            'title'    => [
                'en' => 'Curriculum Materials Service (CMS)',
                'ms' => 'Curriculum Materials Service (CMS) — bahan kurikulum',
            ],
            'category' => ['en' => 'Curriculum', 'ms' => 'Kurikulum'],
            'keywords' => [
                'cms', 'curriculum material', 'curriculum', 'textbook', 'buku teks', 'book',
                'inventory', 'cdd', 'cddinventory', 'stock', 'material', 'inventori',
                'bahan kurikulum', 'stok buku',
                // #========== NEWLY ADDED ============
                'senarai buku', 'agihan', 'pengesahan penerimaan', 'pengurusan bahan kurikulum',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_CDDINVENTORY'],
            // #================================
            // cddinventory.cddinventory.index (Home card) has no role check; ROLE_CDDINVENTORY gets the CMS admin popup
            // #================================
            'url'      => 'cddinventory.cddinventory.index',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Curriculum Materials Service (CMS)** tracks curriculum material inventory and distribution — stock levels, orders and deliveries.",
                // 'ms' => "**Curriculum Materials Service (CMS)** menjejaki inventori dan pengedaran bahan kurikulum — paras stok, pesanan dan penghantaran.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Curriculum Materials Service (CMS)** handles applications and services for curriculum materials — stock, distribution and deliveries.\n\n- **Staff:** open the **CMS** card on the Home page (under *Operations*).\n- **CMS administrators:** open **CMS** on the **Admin** page for *Pengurusan Bahan-Bahan Kurikulum*, *Senarai Agihan & Pengesahan Penerimaan Bahan* and *Senarai Buku*.",
                // 'ms' => "**Curriculum Materials Service (CMS)** mengendalikan permohonan dan perkhidmatan bahan kurikulum — stok, agihan dan penghantaran.\n\n- **Kakitangan:** buka kad **CMS** di Laman Utama (di bawah *Operasi*).\n- **Pentadbir CMS:** buka **CMS** di halaman **Admin** untuk *Pengurusan Bahan-Bahan Kurikulum*, *Senarai Agihan & Pengesahan Penerimaan Bahan* dan *Senarai Buku*.",
                // #================================
                'en' => "**Curriculum Materials Service (CMS)** handles applications and services for curriculum materials — stock, distribution and deliveries.\n\nOpen it from the **CMS** card on the Home page (under *Operations*).",
                'ms' => "**Curriculum Materials Service (CMS)** mengendalikan permohonan dan perkhidmatan bahan kurikulum — stok, agihan dan penghantaran.\n\nBuka melalui kad **CMS** di Laman Utama (di bawah *Operasi*).",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Admin page -> CMS popup; first option is inventory/indexadmin
            'admin'    => [
                'roles'  => ['ROLE_CDDINVENTORY', 'ROLE_SUPERADMIN'],
                'url'    => '/inventory/indexadmin',
                'answer' => [
                    'en' => "**Curriculum Materials Service (CMS)** handles applications and services for curriculum materials — stock, distribution and deliveries.\n\nOpen **CMS** from the **Admin** or **Super Admin** page for *Pengurusan Bahan-Bahan Kurikulum*, *Senarai Agihan & Pengesahan Penerimaan Bahan* and *Senarai Buku*.",
                    'ms' => "**Curriculum Materials Service (CMS)** mengendalikan permohonan dan perkhidmatan bahan kurikulum — stok, agihan dan penghantaran.\n\nBuka **CMS** dari halaman **Admin** atau **Super Admin** untuk *Pengurusan Bahan-Bahan Kurikulum*, *Senarai Agihan & Pengesahan Penerimaan Bahan* dan *Senarai Buku*.",
                ],
            ],
            // #================================
        ],

        /* ---------------------------------------------------------------
         | IT support
         * --------------------------------------------------------------- */

        [
            'id'       => 'dss',
            'title'    => [
                'en' => 'DevOps Support Service (DSS)',
                'ms' => 'DevOps Support Service (DSS) — sokongan IT',
            ],
            'category' => ['en' => 'IT support', 'ms' => 'Sokongan IT'],
            'keywords' => [
                'dss', 'devops support', 'support', 'help', 'it support', 'report problem',
                'report a problem', 'report an issue', 'something is broken', 'raise a ticket',
                'bug', 'error', 'broken', 'not working', 'fault', 'rosak', 'masalah',
                'tidak berfungsi', 'sokongan', 'ticket', 'helpdesk', 'complain system',
                'lapor masalah', 'lapor kerosakan', 'sistem rosak', 'bantuan it',
                // #========== NEWLY ADDED ============
                'dsd', 'support request', 'permohonan sokongan', 'devops support desk',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'url'      => '/servicesdashboard',
            // #================================
            'url'      => '/dsd',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**DevOps Support Service (DSS)** is where you report a fault or ask for IT help.\n\nWhen you raise it, include what you were doing, what you expected, and what actually happened — plus a screenshot if you have one. That gets it resolved much faster.",
                // 'ms' => "**DevOps Support Service (DSS)** ialah tempat anda melaporkan kerosakan atau meminta bantuan IT.\n\nSemasa melaporkan, sertakan apa yang anda sedang lakukan, apa yang anda jangkakan, dan apa yang sebenarnya berlaku — berserta tangkapan skrin jika ada. Ini mempercepatkan penyelesaian.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**DevOps Support Service (DSS)** is where you report a fault or ask for IT help. On the Home page, open **Support Request** (under *Facilities & Support*) and choose **DSS**.\n\nWhen you raise it, include what you were doing, what you expected, and what actually happened — plus a screenshot if you have one. That gets it resolved much faster.",
                // 'ms' => "**DevOps Support Service (DSS)** ialah tempat anda melaporkan kerosakan atau meminta bantuan IT. Di Laman Utama, buka **Permohonan Sokongan** (di bawah *Kemudahan & Sokongan*) dan pilih **DSS**.\n\nSemasa melaporkan, sertakan apa yang anda sedang lakukan, apa yang anda jangkakan, dan apa yang sebenarnya berlaku — berserta tangkapan skrin jika ada. Ini mempercepatkan penyelesaian.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**DevOps Support Service (DSS)** is where you report a fault or ask for IT help.\n\n- **Staff:** Home page → **Support Request** (under *Facilities & Support*) → **DSS**. Include what you were doing, what you expected, and what actually happened — plus a screenshot if you have one. That gets it resolved much faster.\n- **Super administrators:** open **DSS** on the **Super Admin** page to see and handle every ticket.",
                // 'ms' => "**DevOps Support Service (DSS)** ialah tempat anda melaporkan kerosakan atau meminta bantuan IT.\n\n- **Kakitangan:** Laman Utama → **Permohonan Sokongan** (di bawah *Kemudahan & Sokongan*) → **DSS**. Sertakan apa yang anda sedang lakukan, apa yang anda jangkakan, dan apa yang sebenarnya berlaku — berserta tangkapan skrin jika ada. Ini mempercepatkan penyelesaian.\n- **Pentadbir super:** buka **DSS** di halaman **Super Admin** untuk melihat dan mengendalikan setiap tiket.",
                // #================================
                'en' => "**DevOps Support Service (DSS)** is where you report a fault or ask for IT help.\n\nOn the Home page, open **Support Request** (under *Facilities & Support*) and choose **DSS**. Include what you were doing, what you expected, and what actually happened — plus a screenshot if you have one. That gets it resolved much faster.",
                'ms' => "**DevOps Support Service (DSS)** ialah tempat anda melaporkan kerosakan atau meminta bantuan IT.\n\nDi Laman Utama, buka **Permohonan Sokongan** (di bawah *Kemudahan & Sokongan*) dan pilih **DSS**. Sertakan apa yang anda sedang lakukan, apa yang anda jangkakan, dan apa yang sebenarnya berlaku — berserta tangkapan skrin jika ada. Ini mempercepatkan penyelesaian.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Super Admin page -> DSS (support-center.index)
            'admin'    => [
                'roles'  => ['ROLE_SUPERADMIN'],
                'url'    => 'support-center.index',
                'answer' => [
                    'en' => "**DevOps Support Service (DSS)** is where staff report faults and ask for IT help.\n\nOpen **DSS** from the **Super Admin** page to see and handle every ticket.",
                    'ms' => "**DevOps Support Service (DSS)** ialah tempat kakitangan melaporkan kerosakan dan meminta bantuan IT.\n\nBuka **DSS** dari halaman **Super Admin** untuk melihat dan mengendalikan setiap tiket.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'drf',
            'title'    => [
                'en' => 'DevOps Request Form (DRF)',
                'ms' => 'DevOps Request Form (DRF) — permohonan sistem',
            ],
            'category' => ['en' => 'IT support', 'ms' => 'Sokongan IT'],
            'keywords' => [
                'drf', 'devops request', 'request form', 'new system', 'request system',
                'change request', 'new feature', 'permohonan sistem', 'mohon sistem baru',
                'borang permohonan',
            ],
            // #============= ORI CODE ==============
            // 'url'      => '/servicesdashboard',
            // #================================
            'url'      => '/drf',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**DevOps Request Form (DRF)** is for requesting new systems, changes to an existing one, or other IT work.\n\nUse **DSS** instead if something is broken — DRF is for new work, not faults.",
                // 'ms' => "**DevOps Request Form (DRF)** digunakan untuk memohon sistem baharu, perubahan pada sistem sedia ada, atau kerja IT yang lain.\n\nGunakan **DSS** sebaliknya jika ada sesuatu yang rosak — DRF adalah untuk kerja baharu, bukan kerosakan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**DevOps Request Form (DRF)** is for requesting new systems, changes to an existing one, or other IT work. On the Home page, open **Support Request** (under *Facilities & Support*) and choose **DRF**.\n\nUse **DSS** instead if something is broken — DRF is for new work, not faults.",
                // 'ms' => "**DevOps Request Form (DRF)** digunakan untuk memohon sistem baharu, perubahan pada sistem sedia ada, atau kerja IT yang lain. Di Laman Utama, buka **Permohonan Sokongan** (di bawah *Kemudahan & Sokongan*) dan pilih **DRF**.\n\nGunakan **DSS** sebaliknya jika ada sesuatu yang rosak — DRF adalah untuk kerja baharu, bukan kerosakan.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**DevOps Request Form (DRF)** is for requesting new systems, changes to an existing one, or other IT work.\n\n- **Staff:** Home page → **Support Request** (under *Facilities & Support*) → **DRF**.\n- **Super administrators:** open **DRF** on the **Super Admin** page to review the requests.\n\nUse **DSS** instead if something is broken — DRF is for new work, not faults.",
                // 'ms' => "**DevOps Request Form (DRF)** digunakan untuk memohon sistem baharu, perubahan pada sistem sedia ada, atau kerja IT yang lain.\n\n- **Kakitangan:** Laman Utama → **Permohonan Sokongan** (di bawah *Kemudahan & Sokongan*) → **DRF**.\n- **Pentadbir super:** buka **DRF** di halaman **Super Admin** untuk menyemak permohonan.\n\nGunakan **DSS** sebaliknya jika ada sesuatu yang rosak — DRF adalah untuk kerja baharu, bukan kerosakan.",
                // #================================
                'en' => "**DevOps Request Form (DRF)** is for requesting new systems, changes to an existing one, or other IT work.\n\nOn the Home page, open **Support Request** (under *Facilities & Support*) and choose **DRF**. Use **DSS** instead if something is broken — DRF is for new work, not faults.",
                'ms' => "**DevOps Request Form (DRF)** digunakan untuk memohon sistem baharu, perubahan pada sistem sedia ada, atau kerja IT yang lain.\n\nDi Laman Utama, buka **Permohonan Sokongan** (di bawah *Kemudahan & Sokongan*) dan pilih **DRF**. Gunakan **DSS** sebaliknya jika ada sesuatu yang rosak — DRF adalah untuk kerja baharu, bukan kerosakan.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Super Admin page -> DRF (devops-request.indexadmin)
            'admin'    => [
                'roles'  => ['ROLE_SUPERADMIN'],
                'url'    => 'devops-request.indexadmin',
                'answer' => [
                    'en' => "**DevOps Request Form (DRF)** is where staff request new systems, changes to an existing one, or other IT work.\n\nOpen **DRF** from the **Super Admin** page to review the requests.",
                    'ms' => "**DevOps Request Form (DRF)** ialah tempat kakitangan memohon sistem baharu, perubahan pada sistem sedia ada, atau kerja IT yang lain.\n\nBuka **DRF** dari halaman **Super Admin** untuk menyemak permohonan.",
                ],
            ],
            // #================================
        ],

        /* ---------------------------------------------------------------
         | Administration
         * --------------------------------------------------------------- */

        [
            'id'       => 'role-access',
            'title'    => [
                'en' => 'Role Access — request access to a service',
                'ms' => 'Role Access — memohon akses kepada perkhidmatan',
            ],
            'category' => ['en' => 'Administration', 'ms' => 'Pentadbiran'],
            'keywords' => [
                'role access', 'access', 'permission', 'request access', 'cannot see',
                'no access', 'akses', 'kebenaran', 'mohon akses', 'grant access', 'role',
                'roles', 'apply access', 'access denied', 'unauthorized', 'peranan',
                'tiada akses', 'minta akses',
                // #========== NEWLY ADDED ============
                'access required', 'akses diperlukan', 'borang permohonan peranan', 'permohonan peranan',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'url'      => '/servicesdashboard',
            // #================================
            'url'      => '/borangpermohonanperanan',
            // #================================
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Role Access** is where you request access to a MESH service.\n\nSubmit a request naming the service you need, and your department administrator approves it. Once approved, the service appears on your Services Dashboard and in the side menu — you may need to sign out and back in.",
                // 'ms' => "**Role Access** ialah tempat anda memohon akses kepada perkhidmatan MESH.\n\nHantar permohonan dengan menyatakan perkhidmatan yang anda perlukan, dan pentadbir jabatan anda akan meluluskannya. Setelah diluluskan, perkhidmatan itu akan muncul di Papan Pemuka Perkhidmatan dan menu sisi anda — anda mungkin perlu log keluar dan log masuk semula.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Role Access** is where you request access to a MESH service. Open the **Role Access** card on the Home page (under *Facilities & Support*).\n\nSubmit a request naming the service you need, and your department administrator approves it. Once approved, the service card on the Home page stops showing *Access required* — you may need to sign out and back in.",
                // 'ms' => "**Role Access** ialah tempat anda memohon akses kepada perkhidmatan MESH. Buka kad **Akses Peranan** di Laman Utama (di bawah *Kemudahan & Sokongan*).\n\nHantar permohonan dengan menyatakan perkhidmatan yang anda perlukan, dan pentadbir jabatan anda akan meluluskannya. Setelah diluluskan, kad perkhidmatan itu di Laman Utama tidak lagi memaparkan *Akses diperlukan* — anda mungkin perlu log keluar dan log masuk semula.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "**Role Access** is where you request access to a MESH service.\n\n- **Staff:** open the **Role Access** card on the Home page (under *Facilities & Support*) and submit a request naming the service you need. Once it is approved, the service card on the Home page stops showing *Access required* — you may need to sign out and back in.\n- **Super administrators:** review the requests under **Role** → **Request Role** in the side menu, and see current roles under **Role** → **Assigned Role**.",
                // 'ms' => "**Role Access** ialah tempat anda memohon akses kepada perkhidmatan MESH.\n\n- **Kakitangan:** buka kad **Akses Peranan** di Laman Utama (di bawah *Kemudahan & Sokongan*) dan hantar permohonan dengan menyatakan perkhidmatan yang anda perlukan. Setelah diluluskan, kad perkhidmatan itu di Laman Utama tidak lagi memaparkan *Akses diperlukan* — anda mungkin perlu log keluar dan log masuk semula.\n- **Pentadbir super:** semak permohonan di bawah **Peranan** → **Mohon Peranan** di menu sisi, dan lihat peranan semasa di bawah **Peranan** → **Peranan Diberikan**.",
                // #================================
                'en' => "**Role Access** is where you request access to a MESH service.\n\nOpen the **Role Access** card on the Home page (under *Facilities & Support*) and submit a request naming the service you need. Once it is approved, the service card on the Home page stops showing *Access required* — you may need to sign out and back in.",
                'ms' => "**Role Access** ialah tempat anda memohon akses kepada perkhidmatan MESH.\n\nBuka kad **Akses Peranan** di Laman Utama (di bawah *Kemudahan & Sokongan*) dan hantar permohonan dengan menyatakan perkhidmatan yang anda perlukan. Setelah diluluskan, kad perkhidmatan itu di Laman Utama tidak lagi memaparkan *Akses diperlukan* — anda mungkin perlu log keluar dan log masuk semula.",
                // #================================
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Side menu Role -> Request Role (permohonanrole.permohonanrole.indexadmin)
            'admin'    => [
                'roles'  => ['ROLE_SUPERADMIN'],
                'url'    => 'permohonanrole.permohonanrole.indexadmin',
                'answer' => [
                    'en' => "**Role Access** is where staff request access to a MESH service.\n\nReview the requests under **Role** → **Request Role** in the side menu, and see current roles under **Role** → **Assigned Role**.",
                    'ms' => "**Role Access** ialah tempat kakitangan memohon akses kepada perkhidmatan MESH.\n\nSemak permohonan di bawah **Peranan** → **Mohon Peranan** di menu sisi, dan lihat peranan semasa di bawah **Peranan** → **Peranan Diberikan**.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'settings',
            // #============= ORI CODE ==============
            // 'title'    => [
            //     'en' => 'Settings (administrators)',
            //     'ms' => 'Settings — tetapan sistem (pentadbir)',
            // ],
            // #================================
            // adminsettings.adminsettingsdashboard is the "Settings" option inside the D Flow popup, not system-wide settings
            'title'    => [
                'en' => 'D Flow Settings (administrators)',
                'ms' => 'Tetapan D Flow (pentadbir)',
            ],
            // #================================
            'category' => ['en' => 'Administration', 'ms' => 'Pentadbiran'],
            'keywords' => [
                'settings', 'admin settings', 'system settings', 'configuration', 'tetapan',
                'admin panel', 'tetapan sistem',
                // #========== NEWLY ADDED ============
                'd flow settings', 'dflow settings', 'memo settings', 'tetapan d flow',
                // #================================
            ],
            // #============= ORI CODE ==============
            // 'roles'    => ['ROLE_ADMIN', 'ROLE_SUPERADMIN'],
            // #================================
            'roles'    => ['ROLE_EMINITADMIN', 'ROLE_SUPERADMIN'],
            // #================================
            'url'      => 'adminsettings.adminsettingsdashboard',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "**Settings** is the MESH administration area — user accounts, roles, reference data and system configuration.",
                // 'ms' => "**Settings** ialah kawasan pentadbiran MESH — akaun pengguna, peranan, data rujukan dan konfigurasi sistem.",
                // #================================
                'en' => "**Settings** is the D Flow settings area for D Flow administrators. Open the **D Flow** card (on the Home page or the **Admin** page) and choose **Settings**.\n\nUser accounts and roles are managed by super administrators under **Users** and **Role** in the side menu.",
                'ms' => "**Settings** ialah kawasan tetapan D Flow bagi pentadbir D Flow. Buka kad **D Flow** (di Laman Utama atau halaman **Admin**) dan pilih **Settings**.\n\nAkaun pengguna dan peranan diuruskan oleh pentadbir super di bawah **Pengguna** dan **Peranan** di menu sisi.",
                // #================================
            ],
        ],
        // #========== NEWLY ADDED ============
        [
            'id'       => 'admin-page',
            'title'    => [
                'en' => 'Admin and Super Admin pages',
                'ms' => 'Halaman Admin dan Super Admin',
            ],
            'category' => ['en' => 'Administration', 'ms' => 'Pentadbiran'],
            'keywords' => [
                'admin page', 'admin dashboard', 'super admin', 'superadmin', 'administrator',
                'admin services', 'manage service', 'halaman admin', 'halaman pentadbir',
                'pentadbir', 'pentadbir super', 'admin menu',
            ],
            'url'      => 'admindashboard',
            'answer'   => [
                'en' => "If you administer a service, you get an **Admin** link (or **Super Admin** for super administrators) under the *Admin* heading in the side menu. It opens a page of service cards — you only see the cards for the roles you hold.\n\nIt includes the admin views of services staff use from the Home page — **My SSM**, **MNS**, **Q&A**, **MEA**, **MAS**, **D Flow**, **CCAM**, **CMS**, **MRB** and **SRB** — plus admin-only tools such as **HRIDS**, **Post Establishment Management**, **Competency**, **Vacant Position**, **Attendance Data**, **Students & School Staff**, **Housing**, **Student Data**, **SPIS**, **DICTHR**, **TPAWSE**, **PostUp**, **MPC** (Tegahan), and announcement, news and banner management.\n\nIf you have no admin role, the *Admin* heading in the side menu stays empty.",
                'ms' => "Jika anda mentadbir sesuatu perkhidmatan, anda mendapat pautan **Admin** (atau **Super Admin** bagi pentadbir super) di bawah tajuk *Pentadbir* di menu sisi. Ia membuka halaman kad perkhidmatan — anda hanya melihat kad bagi peranan yang anda miliki.\n\nIa termasuk paparan pentadbir bagi perkhidmatan yang digunakan kakitangan dari Laman Utama — **My SSM**, **MNS**, **Q&A**, **MEA**, **MAS**, **D Flow**, **CCAM**, **CMS**, **MRB** dan **SRB** — serta alat khas pentadbir seperti **HRIDS**, **Post Establishment Management**, **Competency**, **Vacant Position**, **Attendance Data**, **Students & School Staff**, **Housing**, **Student Data**, **SPIS**, **DICTHR**, **TPAWSE**, **PostUp**, **MPC** (Tegahan), dan pengurusan pengumuman, berita serta banner.\n\nJika anda tiada peranan pentadbir, tajuk *Pentadbir* di menu sisi kekal kosong.",
            ],
        ],
        // #================================

        /* ---------------------------------------------------------------
         | Navigation
         * --------------------------------------------------------------- */

        [
            'id'       => 'dashboard',
            'title'    => [
                'en' => 'Dashboard',
                'ms' => 'Papan Pemuka (Dashboard)',
            ],
            'category' => ['en' => 'Navigation', 'ms' => 'Navigasi'],
            'keywords' => [
                'dashboard', 'home', 'home page', 'main page', 'front page', 'utama',
                'laman utama', 'start', 'papan pemuka', 'muka depan',
            ],
            'url'      => 'home',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "The **Dashboard** is your landing page after signing in — announcements, news, notifications and quick links.",
                // 'ms' => "**Papan Pemuka** ialah halaman utama anda selepas log masuk — pengumuman, berita, notifikasi dan pautan pantas.",
                // #================================
                'en' => "The **Home** page is your landing page after signing in. It greets you with today's date and your section, school and department, then lists **all MESH services** grouped by category, with a search box.\n\nAnnouncements are in the **bell icon** at the top right. The **Dashboard** item in the side menu holds reports for users who have report roles.",
                'ms' => "**Laman Utama** ialah halaman pertama selepas log masuk. Ia memaparkan ucapan dengan tarikh hari ini serta bahagian, sekolah dan jabatan anda, kemudian menyenaraikan **semua perkhidmatan MESH** mengikut kategori, berserta kotak carian.\n\nPengumuman ada di **ikon loceng** di bahagian atas kanan. Item **Papan Pemuka** di menu sisi mengandungi laporan bagi pengguna yang mempunyai peranan laporan.",
                // #================================
            ],
        ],
        [
            'id'       => 'services-dashboard',
            'title'    => [
                'en' => 'Services Dashboard',
                'ms' => 'Papan Pemuka Perkhidmatan',
            ],
            'category' => ['en' => 'Navigation', 'ms' => 'Navigasi'],
            'keywords' => [
                'services dashboard', 'services', 'all services', 'service list', 'perkhidmatan',
                'senarai perkhidmatan', 'what services', 'apps', 'modules',
                'papan pemuka perkhidmatan', 'semua perkhidmatan',
            ],
            'url'      => 'servicesdashboard',
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "The **Services Dashboard** is the full grid of MESH services you have access to. It only shows services your roles allow, so it looks different for everyone.",
                // 'ms' => "**Papan Pemuka Perkhidmatan** memaparkan keseluruhan senarai perkhidmatan MESH yang anda ada akses kepadanya. Ia hanya menunjukkan perkhidmatan yang dibenarkan oleh peranan anda, jadi paparannya berbeza bagi setiap orang.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "Since September 2026 all MESH services are listed on the **Home** page, grouped into *Human Resource*, *Communication & Notifications*, *Attendance & Events*, *Operations* and *Facilities & Support*. Type in the **Search services** box to find one quickly.\n\nCards you do not have the role for show *Access required* when you hover over them. The older **Services Dashboard** page still works, but it is no longer in the side menu.",
                // 'ms' => "Sejak September 2026 semua perkhidmatan MESH disenaraikan di **Laman Utama**, mengikut kumpulan *Sumber Manusia*, *Komunikasi & Pemberitahuan*, *Kehadiran & Acara*, *Operasi* dan *Kemudahan & Sokongan*. Taip di kotak **Cari perkhidmatan** untuk mencarinya dengan cepat.\n\nKad yang anda tiada peranannya memaparkan *Akses diperlukan* apabila tetikus diletakkan di atasnya. Halaman **Papan Pemuka Perkhidmatan** yang lama masih berfungsi, tetapi tiada lagi di menu sisi.",
                // #================================
                // #============= ORI CODE ==============
                // 'en' => "Since September 2026 all MESH services are listed on the **Home** page, grouped into *Human Resource*, *Communication & Notifications*, *Attendance & Events*, *Operations* and *Facilities & Support*. Type in the **Search services** box to find one quickly.\n\nCards you do not have the role for show *Access required* when you hover over them. Some cards show more options to administrators (for example **D Flow**), and administrators have extra admin views on the **Admin** page. The older **Services Dashboard** page still works, but it is no longer in the side menu.",
                // 'ms' => "Sejak September 2026 semua perkhidmatan MESH disenaraikan di **Laman Utama**, mengikut kumpulan *Sumber Manusia*, *Komunikasi & Pemberitahuan*, *Kehadiran & Acara*, *Operasi* dan *Kemudahan & Sokongan*. Taip di kotak **Cari perkhidmatan** untuk mencarinya dengan cepat.\n\nKad yang anda tiada peranannya memaparkan *Akses diperlukan* apabila tetikus diletakkan di atasnya. Sesetengah kad memaparkan lebih banyak pilihan kepada pentadbir (contohnya **D Flow**), dan pentadbir mempunyai paparan pentadbir tambahan di halaman **Admin**. Halaman **Papan Pemuka Perkhidmatan** yang lama masih berfungsi, tetapi tiada lagi di menu sisi.",
                // #================================
                'en' => "Since September 2026 all MESH services are listed on the **Home** page, grouped into *Human Resource*, *Communication & Notifications*, *Attendance & Events*, *Operations* and *Facilities & Support*. Type in the **Search services** box to find one quickly.\n\nCards you do not have the role for show *Access required* when you hover over them. The older **Services Dashboard** page still works, but it is no longer in the side menu.",
                'ms' => "Sejak September 2026 semua perkhidmatan MESH disenaraikan di **Laman Utama**, mengikut kumpulan *Sumber Manusia*, *Komunikasi & Pemberitahuan*, *Kehadiran & Acara*, *Operasi* dan *Kemudahan & Sokongan*. Taip di kotak **Cari perkhidmatan** untuk mencarinya dengan cepat.\n\nKad yang anda tiada peranannya memaparkan *Akses diperlukan* apabila tetikus diletakkan di atasnya. Halaman **Papan Pemuka Perkhidmatan** yang lama masih berfungsi, tetapi tiada lagi di menu sisi.",
                // #================================
                // #================================
            ],
        ],
        // #========== NEWLY ADDED ============
        [
            'id'       => 'pdms-home',
            'title'    => [
                'en' => 'PDMS Home (Admin Home)',
                'ms' => 'Laman Utama PDMS (Laman Utama Pentadbir)',
            ],
            'category' => ['en' => 'Navigation', 'ms' => 'Navigasi'],
            'keywords' => [
                'pdms', 'pdms home', 'admin home', 'pdms cuti', 'pdms service', 'pdms admin',
                'pdms records', 'rekod pdms', 'laman utama pdms', 'laman utama pentadbir',
            ],
            'roles'    => ['ROLE_SUPERADMIN', 'ROLE_PDMS_ADMIN', 'ROLE_PDMS_SERVICE', 'ROLE_PDMS_CUTI'],
            'url'      => 'pdmshome',
            'answer'   => [
                'en' => "**PDMS Home** (shown as **Admin Home** in the side menu) is the home page for PDMS officers. It shows the same greeting and services as the MESH Home page, plus a PDMS side menu with **PDMS Cuti Records**, **PDMS Service Records** and **PDMS Admin**, depending on your PDMS role.",
                'ms' => "**Laman Utama PDMS** (dipaparkan sebagai **Laman Utama Pentadbir** di menu sisi) ialah halaman utama bagi pegawai PDMS. Ia memaparkan ucapan dan perkhidmatan yang sama seperti Laman Utama MESH, serta menu sisi PDMS dengan **Rekod Cuti PDMS**, **Rekod Perkhidmatan PDMS** dan **Pentadbir PDMS**, bergantung kepada peranan PDMS anda.",
            ],
        ],
        // #================================
    ],

    /*
    | Answers that are not tied to one service.
    */
    'faqs' => [
        [
            'id'       => 'change-password',
            'title'    => [
                'en' => 'Change your password',
                'ms' => 'Menukar kata laluan anda',
            ],
            'keywords' => [
                'change password', 'password', 'reset password', 'forgot password',
                'new password', 'tukar kata laluan', 'kata laluan', 'lupa password',
                'lupa kata laluan', 'set semula kata laluan',
            ],
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "Open the account menu in the top navigation bar and choose **Change Password**.\n\nIf you have forgotten it and cannot sign in at all, raise a **DevOps Support Service (DSS)** request — the bot cannot reset passwords.",
                // 'ms' => "Buka menu akaun di bar navigasi atas dan pilih **Change Password**.\n\nJika anda terlupa dan langsung tidak dapat log masuk, hantar permohonan **DevOps Support Service (DSS)** — saya tidak boleh menetapkan semula kata laluan.",
                // #================================
                'en' => "Click **your name** at the top right of the page and choose **Change Password**.\n\nIf you have forgotten it and cannot sign in at all, raise a **DevOps Support Service (DSS)** request — the bot cannot reset passwords.",
                'ms' => "Klik **nama anda** di bahagian atas kanan halaman dan pilih **Tukar Kata Laluan**.\n\nJika anda terlupa dan langsung tidak dapat log masuk, hantar permohonan **DevOps Support Service (DSS)** — saya tidak boleh menetapkan semula kata laluan.",
                // #================================
            ],
        ],
        [
            'id'       => 'cannot-see-service',
            'title'    => [
                'en' => 'A service is missing from your menu',
                'ms' => 'Perkhidmatan tiada dalam menu anda',
            ],
            'keywords' => [
                'cannot see', 'not showing', 'missing service', 'service missing', 'hidden',
                'tidak nampak', 'tiada', 'why cant i see', 'do not see', "don't see",
                'menu missing', 'no menu', 'tak nampak', 'hilang dari menu',
                'kenapa tidak nampak',
                // #========== NEWLY ADDED ============
                'greyed out', 'grey card', 'cannot click', 'tidak boleh klik', 'kad kelabu',
                'where did services go', 'services moved', 'fsm missing', 'mana perkhidmatan',
                'only see form', 'no admin button', 'tiada butang admin',
                // #================================
            ],
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "Almost always a missing role. MESH hides every service you do not hold the role for.\n\n1. Ask me **\"what is my access\"** and I will list the roles on your account.\n2. If the role you need is not there, request it through **Role Access**.\n3. Your department administrator approves it.\n\nAfter approval, sign out and back in for the menu to refresh.",
                // 'ms' => "Hampir selalunya kerana peranan yang tiada. MESH menyembunyikan setiap perkhidmatan yang anda tidak mempunyai peranannya.\n\n1. Tanya saya **\"apa akses saya\"** dan saya akan senaraikan peranan pada akaun anda.\n2. Jika peranan yang anda perlukan tiada, mohon melalui **Role Access**.\n3. Pentadbir jabatan anda akan meluluskannya.\n\nSelepas diluluskan, log keluar dan log masuk semula supaya menu dikemas kini.",
                // #================================
                'en' => "First, check the **Home** page — since September 2026 the services (including *Services* and *F.S.M*, now **FSD**) are listed there instead of in the side menu.\n\nMESH shows each service by role. Staff usually go straight to a service's form (for example **MAS** opens the attendance slip), while administrators of that service also get its admin view from the **Admin** page. If a card is greyed out with *Access required*, an option is missing, or you only see the form when you expected the admin view, it is almost always a missing role:\n\n1. Ask me **\"what is my access\"** and I will list the roles on your account.\n2. If the role you need is not there, request it through **Role Access**.\n3. Your department administrator approves it.\n\nAfter approval, sign out and back in for the page to refresh.",
                'ms' => "Pertama, semak **Laman Utama** — sejak September 2026 perkhidmatan (termasuk *Services* dan *F.S.M*, kini **FSD**) disenaraikan di situ dan bukan lagi di menu sisi.\n\nMESH memaparkan setiap perkhidmatan mengikut peranan. Kakitangan biasanya terus ke borang perkhidmatan (contohnya **MAS** membuka slip kehadiran), manakala pentadbir perkhidmatan itu juga mendapat paparan pentadbir dari halaman **Admin**. Jika kad berwarna kelabu dengan *Akses diperlukan*, sesuatu pilihan tiada, atau anda hanya melihat borang sedangkan anda menjangkakan paparan pentadbir, hampir selalunya kerana peranan yang tiada:\n\n1. Tanya saya **\"apa akses saya\"** dan saya akan senaraikan peranan pada akaun anda.\n2. Jika peranan yang anda perlukan tiada, mohon melalui **Role Access**.\n3. Pentadbir jabatan anda akan meluluskannya.\n\nSelepas diluluskan, log keluar dan log masuk semula supaya halaman dikemas kini.",
                // #================================
            ],
        ],
        [
            'id'       => 'contact',
            'title'    => [
                'en' => 'Who to contact',
                'ms' => 'Siapa yang perlu dihubungi',
            ],
            'keywords' => [
                'who to contact', 'contact', 'who do i ask', 'help me', 'phone', 'email',
                'hubungi', 'siapa', 'talk to someone', 'human', 'staff',
                'siapa perlu dihubungi', 'nak tanya siapa',
            ],
            'answer'   => [
                'en' => "Depends on what you need:\n\n- **Something is broken** — DevOps Support Service (DSS).\n- **Need a new system or a change** — DevOps Request Form (DRF).\n- **Access to a service** — Role Access, then your department administrator.\n- **Your SSM record is wrong** — SSM Enquiries.\n- **Leave, positions, personal particulars** — your department HR administrator.",
                'ms' => "Bergantung kepada apa yang anda perlukan:\n\n- **Ada sesuatu yang rosak** — DevOps Support Service (DSS).\n- **Perlukan sistem baharu atau perubahan** — DevOps Request Form (DRF).\n- **Akses kepada perkhidmatan** — Role Access, kemudian pentadbir jabatan anda.\n- **Rekod SSM anda tidak tepat** — SSM Enquiries.\n- **Cuti, jawatan, butiran peribadi** — pentadbir HR jabatan anda.",
            ],
        ],
        // #========== NEWLY ADDED ============
        [
            'id'       => 'announcements',
            'title'    => [
                'en' => 'Announcements (bell icon)',
                'ms' => 'Pengumuman (ikon loceng)',
            ],
            'keywords' => [
                'announcement', 'announcements', 'pengumuman', 'notis', 'notice', 'bell',
                'bell icon', 'loceng', 'news', 'berita', 'latest news', 'unread', 'mark as read',
                'tandakan dibaca', 'email announcements', 'subscribe', 'unsubscribe',
                'langgan', 'berhenti langgan', 'email me', 'e-mel pengumuman',
            ],
            'answer'   => [
                // #============= ORI CODE ==============
                // 'en' => "Ministry announcements are in the **bell icon** at the top right of every page. The red number shows how many you have not read.\n\n- Click an announcement to open it in full.\n- **Mark all as read** clears the count.\n- **Email me new announcements** sends new ones to your email; click it again (*Stop email notifications*) to stop.\n- **View all** opens the full announcements archive.\n\nSuper administrators publish announcements and news from the **MA** and **MN** cards on the **Super Admin** page.",
                // 'ms' => "Pengumuman kementerian ada di **ikon loceng** di bahagian atas kanan setiap halaman. Nombor merah menunjukkan bilangan yang belum dibaca.\n\n- Klik sesuatu pengumuman untuk membukanya sepenuhnya.\n- **Tandakan semua sudah dibaca** mengosongkan kiraan.\n- **E-melkan pengumuman baharu kepada saya** menghantar pengumuman baharu ke e-mel anda; klik sekali lagi (*Hentikan pemberitahuan e-mel*) untuk berhenti.\n- **Lihat semua** membuka arkib penuh pengumuman.\n\nPentadbir super menerbitkan pengumuman dan berita melalui kad **MA** dan **MN** di halaman **Super Admin**.",
                // #================================
                'en' => "Ministry announcements are in the **bell icon** at the top right of every page. The red number shows how many you have not read.\n\n- Click an announcement to open it in full.\n- **Mark all as read** clears the count.\n- **Email me new announcements** sends new ones to your email; click it again (*Stop email notifications*) to stop.\n- **View all** opens the full announcements archive.",
                'ms' => "Pengumuman kementerian ada di **ikon loceng** di bahagian atas kanan setiap halaman. Nombor merah menunjukkan bilangan yang belum dibaca.\n\n- Klik sesuatu pengumuman untuk membukanya sepenuhnya.\n- **Tandakan semua sudah dibaca** mengosongkan kiraan.\n- **E-melkan pengumuman baharu kepada saya** menghantar pengumuman baharu ke e-mel anda; klik sekali lagi (*Hentikan pemberitahuan e-mel*) untuk berhenti.\n- **Lihat semua** membuka arkib penuh pengumuman.",
                // #================================
            ],
            // #========== NEWLY ADDED ============
            // Super Admin page -> MA (announcement.announcementadmin)
            'admin'    => [
                'roles'  => ['ROLE_SUPERADMIN'],
                'url'    => 'announcement.announcementadmin',
                'answer' => [
                    'en' => "Ministry announcements appear in the **bell icon** at the top right of every page.\n\nPublish announcements and news from the **MA** and **MN** cards on the **Super Admin** page.",
                    'ms' => "Pengumuman kementerian dipaparkan di **ikon loceng** di bahagian atas kanan setiap halaman.\n\nTerbitkan pengumuman dan berita melalui kad **MA** dan **MN** di halaman **Super Admin**.",
                ],
            ],
            // #================================
        ],
        [
            'id'       => 'dark-mode',
            'title'    => [
                'en' => 'Dark mode',
                'ms' => 'Mod gelap',
            ],
            'keywords' => [
                'dark mode', 'dark theme', 'night mode', 'light mode', 'theme', 'too bright',
                'eyes hurt', 'black background', 'sun icon', 'moon icon', 'mod gelap',
                'mod cerah', 'tema', 'terlalu terang', 'latar gelap', 'ikon bulan',
                'ikon matahari',
            ],
            'answer'   => [
                'en' => "Click the **sun / moon button** at the top right, next to the bell, to switch between light and dark mode. MESH remembers your choice on that browser.\n\nIf some text is hard to read in dark mode on a particular page, report the page through **DevOps Support Service (DSS)**.",
                'ms' => "Klik **butang matahari / bulan** di bahagian atas kanan, di sebelah loceng, untuk bertukar antara mod cerah dan mod gelap. MESH mengingati pilihan anda pada pelayar tersebut.\n\nJika ada teks yang sukar dibaca dalam mod gelap pada halaman tertentu, laporkan halaman itu melalui **DevOps Support Service (DSS)**.",
            ],
        ],
        [
            'id'       => 'language',
            'title'    => [
                'en' => 'Switch language (English / Bahasa Melayu)',
                'ms' => 'Tukar bahasa (English / Bahasa Melayu)',
            ],
            'keywords' => [
                'language', 'change language', 'switch language', 'malay', 'bahasa melayu',
                'english', 'bm', 'en', 'translate', 'translation', 'bahasa', 'tukar bahasa',
                'terjemah', 'dalam bahasa melayu', 'in english',
            ],
            'answer'   => [
                'en' => "Use the **EN / BM** switch at the top right, left of the sun / moon button. **BM** shows the menus, headings and service cards in Bahasa Melayu; **EN** switches back. MESH remembers your choice on that browser.\n\nSome pages and data (names, records, documents) stay in the language they were written in.",
                'ms' => "Gunakan suis **EN / BM** di bahagian atas kanan, di sebelah kiri butang matahari / bulan. **BM** memaparkan menu, tajuk dan kad perkhidmatan dalam Bahasa Melayu; **EN** menukar semula ke Bahasa Inggeris. MESH mengingati pilihan anda pada pelayar tersebut.\n\nSesetengah halaman dan data (nama, rekod, dokumen) kekal dalam bahasa asalnya.",
            ],
        ],
        [
            'id'       => 'my-profile',
            'title'    => [
                'en' => 'My Profile',
                'ms' => 'Profil Saya',
            ],
            'keywords' => [
                'my profile', 'profile', 'biodata', 'my details', 'personal details',
                'update profile', 'edit profile', 'my info', 'profil', 'profil saya',
                'maklumat peribadi', 'kemas kini profil', 'butiran saya',
            ],
            'answer'   => [
                'en' => "Click **your name** at the top right and choose **My Profile**, or use **Profile** in the side menu. It shows your biodata and employment details — the same record the Home page greeting uses for your section, school and department.\n\nIf your section or department on the Home page is wrong, it comes from this record — ask your department HR administrator to correct it.",
                'ms' => "Klik **nama anda** di bahagian atas kanan dan pilih **Profil Saya**, atau gunakan **Profil** di menu sisi. Ia memaparkan biodata dan maklumat perkhidmatan anda — rekod yang sama digunakan oleh ucapan di Laman Utama untuk bahagian, sekolah dan jabatan anda.\n\nJika bahagian atau jabatan anda di Laman Utama tidak tepat, ia datang daripada rekod ini — minta pentadbir HR jabatan anda membetulkannya.",
            ],
        ],
        [
            'id'       => 'sign-out',
            'title'    => [
                'en' => 'Sign out',
                'ms' => 'Log keluar',
            ],
            'keywords' => [
                'sign out', 'log out', 'logout', 'signout', 'exit', 'log keluar', 'keluar',
                'how to logout',
            ],
            'answer'   => [
                'en' => "Click **your name** at the top right and choose **Sign Out**. Always sign out on a shared computer.",
                'ms' => "Klik **nama anda** di bahagian atas kanan dan pilih **Log Keluar**. Sentiasa log keluar apabila menggunakan komputer yang dikongsi.",
            ],
        ],
        [
            'id'       => 'reports',
            'title'    => [
                'en' => 'Reports (side menu Dashboard)',
                'ms' => 'Laporan (Papan Pemuka di menu sisi)',
            ],
            'keywords' => [
                'report', 'reports', 'laporan', 'users report', 'art report', 'jpkk report',
                'sjk report', 'ons report', 'tegahan report', 'genai report', 'pps visitors',
                'statistics', 'statistik', 'laporan pengguna',
            ],
            'answer'   => [
                'en' => "Reports are under **Dashboard** in the side menu. Each report only appears if you hold its role:\n\n- **Users Report**, **ART Report** — management\n- **PPS Visitors** — PPS dashboard role\n- **JPKK Report** — management or CCA admin\n- **SJK Report** — Prestasi or Jawatan Kosong roles\n- **Tegahan Report** — Tegahan role\n- **ONS Report**, **GenAI Report** — super administrators\n\nIf Dashboard opens empty, you have none of these roles — request one through **Role Access** if you need it.",
                'ms' => "Laporan ada di bawah **Papan Pemuka** di menu sisi. Setiap laporan hanya muncul jika anda mempunyai peranannya:\n\n- **Laporan Pengguna**, **Laporan ART** — pengurusan\n- **Pelawat PPS** — peranan papan pemuka PPS\n- **Laporan JPKK** — pengurusan atau pentadbir CCA\n- **Laporan SJK** — peranan Prestasi atau Jawatan Kosong\n- **Laporan Tegahan** — peranan Tegahan\n- **Laporan ONS**, **Laporan GenAI** — pentadbir super\n\nJika Papan Pemuka kosong, anda tiada sebarang peranan ini — mohon melalui **Role Access** jika perlu.",
            ],
        ],
        // #================================
    ],
];
