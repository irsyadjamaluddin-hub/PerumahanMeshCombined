<?php

/*
|--------------------------------------------------------------------------
| MESH Smart Bot — phrases
|--------------------------------------------------------------------------
|
| Everything the bot says that is not an answer from the knowledge base.
| Each phrase has an English ('en') and Malay ('ms') version.
|
| :placeholders are filled in by the responder.
|
*/

return [

    'greeting' => [
        'en' => 'Hello:name. What do you need — a service, where to find something, or what access you have?',
        'ms' => 'Helo:name. Apa yang boleh saya bantu — perkhidmatan, di mana hendak cari sesuatu, atau akses yang anda ada?',
    ],

    'thanks' => [
        'en' => 'Any time. Ask me again whenever you need to.',
        'ms' => 'Sama-sama. Tanya saja bila-bila anda perlukan.',
    ],

    'bye' => [
        'en' => 'Take care.',
        'ms' => 'Jaga diri.',
    ],

    'prompt_empty' => [
        'en' => 'Ask me anything about MESH — a service, where to find something, or what access you have.',
        'ms' => 'Tanya saya apa sahaja tentang MESH — perkhidmatan, di mana hendak cari sesuatu, atau akses yang anda ada.',
    ],

    /* ---------------------------------------------------------------- */

    'go_there' => [
        'en' => 'Go there: :link',
        'ms' => 'Pergi ke sana: :link',
    ],

    'role_missing' => [
        'en' => "Your account does not currently hold the role this needs (:roles), so it will not appear in your menu.\n\nRequest it through **Role Access** on the Services Dashboard, then ask your department administrator to approve it.",
        'ms' => "Akaun anda belum mempunyai peranan yang diperlukan (:roles), jadi perkhidmatan ini tidak akan muncul dalam menu anda.\n\nMohon melalui **Role Access** di Papan Pemuka Perkhidmatan, kemudian minta pentadbir jabatan anda meluluskannya.",
    ],

    /* ---------------------------------------------------------------- */

    'access_none' => [
        'en' => "There are no roles recorded on your account, so you will only see the basic MESH pages.\n\nRequest what you need through **Role Access** on the Services Dashboard.",
        'ms' => "Tiada peranan direkodkan pada akaun anda, jadi anda hanya akan melihat halaman asas MESH sahaja.\n\nMohon apa yang anda perlukan melalui **Role Access** di Papan Pemuka Perkhidmatan.",
    ],

    'access_holds' => [
        'en' => 'Your account holds :count role(s):',
        'ms' => 'Akaun anda mempunyai :count peranan:',
    ],

    'access_unlocks' => [
        'en' => 'These unlock: :services.',
        'ms' => 'Peranan ini membuka: :services.',
    ],

    'access_more' => [
        'en' => 'Need something else? Request it through **Role Access**.',
        'ms' => 'Perlukan yang lain? Mohon melalui **Role Access**.',
    ],

    /* ---------------------------------------------------------------- */

    'self_intro' => [
        'en' => "I am ELIA, the MESH assistant. I run on this server and answer from a written guide to MESH — I do not have access to your records, so I cannot check a leave balance, chase an application, or reset a password.\n\nWhat I can do:\n\n- Point you to any MESH service and tell you what it is for\n- Tell you which roles your account holds and what they unlock\n- Explain why a service is missing from your menu\n- Tell you who to contact when I cannot help\n\nI answer in English or Malay — just write in whichever you prefer.\n\nI cover: :categories.",
        'ms' => "Saya ELIA, pembantu MESH. Saya beroperasi pada pelayan ini dan menjawab berdasarkan panduan bertulis tentang MESH — saya tiada akses kepada rekod anda, jadi saya tidak boleh menyemak baki cuti, mengesan permohonan, atau menetapkan semula kata laluan.\n\nApa yang saya boleh buat:\n\n- Menunjukkan mana-mana perkhidmatan MESH dan menerangkan kegunaannya\n- Memberitahu peranan yang ada pada akaun anda dan apa yang dibukanya\n- Menerangkan mengapa sesuatu perkhidmatan tiada dalam menu anda\n- Memberitahu siapa yang perlu dihubungi apabila saya tidak dapat membantu\n\nSaya menjawab dalam Bahasa Melayu atau Bahasa Inggeris — tulis sahaja dalam bahasa pilihan anda.\n\nSaya meliputi: :categories.",
    ],

    /* ---------------------------------------------------------------- */

    'no_match' => [
        'en' => "I could not match that to anything in my guide.\n\nI only know what has been written down about MESH — I cannot look up records or answer general questions. Try naming the service or task directly, for example *\"book a meeting room\"* or *\"where is my leave balance\"*.",
        'ms' => "Saya tidak dapat memadankan itu dengan apa-apa dalam panduan saya.\n\nSaya hanya tahu apa yang telah ditulis tentang MESH — saya tidak boleh menyemak rekod atau menjawab soalan umum. Cuba nyatakan nama perkhidmatan atau tugas secara terus, contohnya *\"tempah bilik mesyuarat\"* atau *\"di mana baki cuti saya\"*.",
    ],

    'no_match_dss' => [
        'en' => 'If this is a fault, raise it through **DevOps Support Service (DSS)**.',
        'ms' => 'Jika ini satu kerosakan, laporkannya melalui **DevOps Support Service (DSS)**.',
    ],

    /* ---------------------------------------------------------------- */

    // Suggestion chips offered when the bot has nothing better to show.
    'starters' => [
        'en' => ['Book a meeting room', 'What is my access?', 'Where is my leave balance?', 'Report a problem'],
        'ms' => ['Tempah bilik mesyuarat', 'Apa akses saya?', 'Di mana baki cuti saya?', 'Lapor masalah'],
    ],

    /*
    | Labels and messages shown by the widget itself, rather than spoken by
    | the bot. Passed to the browser, so keep them plain text.
    */
    'widget' => [

        'subtitle' => [
            'en' => 'MESH help — services, access, where to go',
            'ms' => 'Bantuan MESH — perkhidmatan, akses, ke mana hendak pergi',
        ],

        'placeholder' => [
            'en' => 'Ask about a MESH service…',
            'ms' => 'Tanya tentang perkhidmatan MESH…',
        ],

        'opening' => [
            'en' => "Hi:name. I can point you to any MESH service, tell you what access your account has, and explain why something is missing from your menu.\n\nI answer from a written guide to MESH, so I cannot look up your records or check an application. Write in English or Malay — I reply in whichever you use.",
            'ms' => "Hai:name. Saya boleh menunjukkan mana-mana perkhidmatan MESH, memberitahu akses yang ada pada akaun anda, dan menerangkan mengapa sesuatu tiada dalam menu anda.\n\nSaya menjawab berdasarkan panduan bertulis tentang MESH, jadi saya tidak boleh menyemak rekod atau permohonan anda. Tulis dalam Bahasa Melayu atau Bahasa Inggeris — saya akan membalas dalam bahasa yang anda gunakan.",
        ],

        'open'      => ['en' => 'Open ELIA',             'ms' => 'Buka ELIA'],
        'close'     => ['en' => 'Close',                 'ms' => 'Tutup'],
        'reset'     => ['en' => 'New conversation',      'ms' => 'Perbualan baharu'],
        'send'      => ['en' => 'Send',                  'ms' => 'Hantar'],
        'question'  => ['en' => 'Your question',         'ms' => 'Soalan anda'],

        // Language toggle. 'auto_label' is what the button shows when the bot
        // is detecting the language per question.
        'language'   => ['en' => 'Reply language',       'ms' => 'Bahasa jawapan'],
        'auto_label' => ['en' => 'Auto',                 'ms' => 'Auto'],

        'error_session' => [
            'en' => 'Your session expired. Please refresh the page and try again.',
            'ms' => 'Sesi anda telah tamat. Sila muat semula halaman dan cuba lagi.',
        ],
        'error_rate' => [
            'en' => "You're sending questions a bit too quickly. Please wait a moment.",
            'ms' => 'Anda menghantar soalan terlalu cepat. Sila tunggu sebentar.',
        ],
        'error_auth' => [
            'en' => 'Please sign in again to use ELIA.',
            'ms' => 'Sila log masuk semula untuk menggunakan ELIA.',
        ],
        'error_generic' => [
            'en' => 'Something went wrong. Please try again.',
            'ms' => 'Sesuatu tidak kena. Sila cuba lagi.',
        ],
        'error_network' => [
            'en' => 'Could not reach ELIA. Check your connection and try again.',
            'ms' => 'Tidak dapat menghubungi ELIA. Semak sambungan anda dan cuba lagi.',
        ],
    ],

];
