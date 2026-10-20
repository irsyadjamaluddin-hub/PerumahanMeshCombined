<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MESH Smart Bot
    |--------------------------------------------------------------------------
    |
    | The in-app assistant shown on every MESH page. It answers entirely on
    | this server from the knowledge file below — no external service, no API
    | key, no network call.
    |
    | Set MESHBOT_ENABLED=false to hide the widget everywhere without touching
    | any Blade file.
    |
    */

    'enabled' => env('MESHBOT_ENABLED', true),

    'name' => env('MESHBOT_NAME', 'ELIA'),

    // What the bot knows. Add entries here to teach it about a new service —
    // no code change needed. Run `php artisan cache:clear` to pick up edits.
    'knowledge_file' => resource_path('meshbot/knowledge.php'),

    // Everything the bot says that is not a knowledge-base answer.
    'phrases_file' => resource_path('meshbot/phrases.php'),

    // The bot replies in whichever language the question was asked in. This is
    // the fallback for questions too short to tell — "ssm", "settings" — and
    // for the widget's opening greeting. 'en' or 'ms'.
    'default_language' => env('MESHBOT_DEFAULT_LANG', 'en'),

    // Max characters accepted in a single question.
    'max_message_length' => (int) env('MESHBOT_MAX_MESSAGE_LENGTH', 1000),

    // How many turns the widget keeps on screen before trimming.
    'history_limit' => (int) env('MESHBOT_HISTORY_LIMIT', 40),

    // Requests per minute, per user.
    'rate_limit' => env('MESHBOT_RATE_LIMIT', '60,1'),

];
