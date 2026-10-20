<?php

namespace App\Services\SmartBot;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/**
 * Answers MESH questions entirely on this server — no external service, no
 * model, no network call.
 *
 * A question is normalised, scored against the keyword sets in
 * resources/meshbot/knowledge.php, and the best-matching entry is returned.
 * When nothing scores well enough the responder says so and offers the closest
 * entries as suggestions rather than guessing.
 *
 * English and Malay are both supported. Keywords are shared across the two, so
 * a Malay question can still reach an entry through its English keywords; only
 * the reply is language-specific. The language is detected per question unless
 * the caller pins one.
 */
class SmartBotResponder
{
    /** Below this score a match is not trusted. */
    private const CONFIDENT = 8;

    /** Above this a match is good enough to answer without hedging. */
    private const CERTAIN = 18;

    public const LANGUAGES = ['en', 'ms'];

    /** Words carrying no matching signal, English and Malay. */
    private const STOPWORDS = [
        'a', 'about', 'ada', 'adakah', 'after', 'ah', 'aku', 'all', 'am', 'an', 'and', 'any',
        'apa', 'apakah', 'are', 'as', 'at', 'atau', 'bagaimana', 'be', 'been', 'bila', 'boleh',
        'bolehkah', 'but', 'by', 'can', 'cara', 'could', 'dan', 'dengan', 'di', 'did', 'do',
        'does', 'for', 'from', 'get', 'give', 'go', 'had', 'has', 'have', 'he', 'help', 'her',
        'here', 'his', 'how', 'i', 'if', 'in', 'ini', 'into', 'is', 'it', 'itu', 'ke', 'kepada',
        'know', 'macam', 'make', 'mana', 'mau', 'may', 'me', 'mesh', 'my', 'nak', 'need', 'of',
        'on', 'or', 'pada', 'please', 'saya', 'should', 'siapa', 'so', 'some', 'tell', 'that',
        'the', 'their', 'them', 'there', 'these', 'they', 'this', 'to', 'tolong', 'untuk', 'up',
        'use', 'want', 'was', 'we', 'were', 'what', 'when', 'where', 'which', 'who', 'why',
        'will', 'with', 'would', 'yang', 'you', 'your',
    ];

    /**
     * Malay function words. Strong evidence — these have no English meaning.
     */
    private const MALAY_MARKERS = [
        'adakah', 'adalah', 'anda', 'apa', 'apakah', 'atau', 'awak', 'bagaimana', 'belum',
        'berapa', 'bila', 'boleh', 'bolehkah', 'cara', 'dapat', 'dari', 'daripada', 'dengan',
        'di', 'dia', 'hendak', 'ialah', 'ini', 'itu', 'jika', 'juga', 'kalau', 'kami', 'kat',
        'ke', 'kena', 'kenapa', 'kepada', 'kita', 'lagi', 'macam', 'mahu', 'mana', 'mengapa',
        'mereka', 'nak', 'pada', 'saya', 'sila', 'sini', 'situ', 'siapa', 'sudah', 'tak',
        'tidak', 'tolong', 'untuk', 'yang',
        // Greetings and courtesies — unambiguous, and often the whole message.
        'selamat', 'terima', 'kasih', 'pagi', 'petang', 'tengahari',
    ];

    /**
     * Malay content words. Weaker evidence — enough to tip a short question
     * like "tempah bilik" that contains no function words at all.
     */
    private const MALAY_TERMS = [
        'aduan', 'akses', 'aktifkan', 'baki', 'bantuan', 'bahan', 'bilik', 'borang', 'buku',
        'cari', 'cuti', 'daftar', 'halaman', 'hantar', 'jabatan', 'jawatan', 'kakitangan',
        'kata', 'kebenaran', 'kehadiran', 'kelab', 'kerosakan', 'kokurikulum', 'kurikulum',
        'laluan', 'lapor', 'lihat', 'maklumat', 'masalah', 'memangku', 'mesyuarat', 'mohon',
        'notis', 'pautan', 'pemuka', 'pengumuman', 'pentadbir', 'peranan', 'perkhidmatan',
        'permohonan', 'persaraan', 'pingat', 'prestasi', 'rekod', 'rosak', 'semak', 'senarai',
        'sindiket', 'sistem', 'sokongan', 'stok', 'tempah', 'tempahan', 'tetapan', 'tindakan',
        'tukar', 'tuntutan',
        // Greetings used by English speakers here too, so only a weak signal.
        'assalamualaikum', 'hai', 'helo', 'jalan', 'malam', 'salam', 'tinggal',
    ];

    /**
     * English function words. Deliberately excludes anything that is also a
     * Malay word.
     */
    private const ENGLISH_MARKERS = [
        'about', 'and', 'are', 'can', 'could', 'did', 'does', 'find', 'for', 'from', 'get',
        'how', 'is', 'me', 'my', 'need', 'please', 'see', 'should', 'show', 'that', 'the',
        'there', 'this', 'want', 'was', 'were', 'what', 'when', 'where', 'which', 'who', 'why',
        'with', 'would',
    ];

    /**
     * @param  array<int, string>  $roles  The signed-in user's role names.
     * @param  string|null  $lang  'en' or 'ms' to pin a language; null to detect.
     * @return array{reply: string, suggestions: array<int, string>, lang: string}
     */
    public function answer(string $question, array $roles = [], ?string $firstName = null, ?string $lang = null): array
    {
        $normalised = $this->normalise($question);
        $lang = $this->resolveLanguage($normalised, $lang);

        if ($normalised === '') {
            return $this->reply($this->phrase('prompt_empty', $lang), $lang);
        }

        if ($intent = $this->smallTalk($normalised, $lang, $firstName)) {
            return $intent;
        }

        if ($this->asksAboutOwnAccess($normalised)) {
            return $this->describeAccess($roles, $lang);
        }

        if ($this->asksWhatICanDo($normalised)) {
            return $this->describeSelf($lang);
        }

        return $this->lookup($normalised, $roles, $lang);
    }

    /**
     * Labels, opening message and suggestion chips for the widget, in every
     * supported language.
     *
     * @return array{default: string, strings: array<string, array<string, string>>, starters: array<string, array<int, string>>}
     */
    public function widgetStrings(?string $firstName = null): array
    {
        $phrases = $this->phrases();
        $strings = [];

        foreach (array_keys($phrases['widget'] ?? []) as $key) {
            foreach (self::LANGUAGES as $lang) {
                $strings[$key][$lang] = str_replace(
                    ':name',
                    $firstName ? " {$firstName}" : '',
                    $this->localise($phrases['widget'][$key], $lang)
                );
            }
        }

        $starters = [];

        foreach (self::LANGUAGES as $lang) {
            $starters[$lang] = $this->starters($lang);
        }

        return [
            'default'  => $this->defaultLanguage(),
            'strings'  => $strings,
            'starters' => $starters,
        ];
    }

    /* ------------------------------------------------------------------ */
    /* Language                                                            */
    /* ------------------------------------------------------------------ */

    private function resolveLanguage(string $normalised, ?string $pinned): string
    {
        if (in_array($pinned, self::LANGUAGES, true)) {
            return $pinned;
        }

        return $this->detectLanguage($normalised);
    }

    /**
     * Weigh Malay evidence against English. Function words count double
     * because they are unambiguous; content words only break ties on short
     * questions that carry no function words at all.
     */
    private function detectLanguage(string $normalised): string
    {
        // Detection runs on raw words, not the stopword-filtered tokens used
        // for matching — the function words ARE the signal here.
        $words = array_filter(explode(' ', $normalised));

        $malay = 0;
        $english = 0;

        foreach ($words as $word) {
            if (in_array($word, self::MALAY_MARKERS, true)) {
                $malay += 2;
            } elseif (in_array($word, self::MALAY_TERMS, true)) {
                $malay += 1;
            }

            if (in_array($word, self::ENGLISH_MARKERS, true)) {
                $english += 2;
            }
        }

        if ($malay > $english) {
            return 'ms';
        }

        if ($english > $malay) {
            return 'en';
        }

        return $this->defaultLanguage();
    }

    private function defaultLanguage(): string
    {
        $default = config('meshbot.default_language', 'en');

        return in_array($default, self::LANGUAGES, true) ? $default : 'en';
    }

    /**
     * Pick the right language out of an ['en' => ..., 'ms' => ...] value,
     * falling back to English so a half-translated entry still works.
     *
     * @param  array<string, string>|string|null  $value
     */
    private function localise($value, string $lang): string
    {
        if (is_array($value)) {
            return (string) ($value[$lang] ?? $value['en'] ?? reset($value) ?: '');
        }

        return (string) $value;
    }

    /**
     * @param  array<string, string>  $replace
     * @return string|array<int, string>
     */
    private function phrase(string $key, string $lang, array $replace = [])
    {
        $phrases = $this->phrases();
        $value = $phrases[$key][$lang] ?? $phrases[$key]['en'] ?? '';

        if (is_array($value)) {
            return $value;
        }

        foreach ($replace as $search => $with) {
            $value = str_replace(':' . $search, $with, $value);
        }

        return $value;
    }

    /* ------------------------------------------------------------------ */
    /* Knowledge lookup                                                    */
    /* ------------------------------------------------------------------ */

    /**
     * @param  array<int, string>  $roles
     * @return array{reply: string, suggestions: array<int, string>, lang: string}
     */
    private function lookup(string $normalised, array $roles, string $lang): array
    {
        $tokens = $this->tokenise($normalised);
        $scored = [];

        foreach ($this->entries() as $entry) {
            $score = $this->score($entry, $normalised, $tokens);

            if ($score > 0) {
                $scored[] = ['entry' => $entry, 'score' => $score];
            }
        }

        if (! $scored) {
            return $this->noMatch($lang);
        }

        usort($scored, fn ($a, $b) => $b['score'] <=> $a['score']);

        $best = $scored[0];

        if ($best['score'] < self::CONFIDENT) {
            return $this->noMatch($lang, $scored);
        }

        $reply = $this->render($best['entry'], $roles, $lang);

        // A weak-but-usable match might be the wrong entry, so offer the
        // runners-up alongside the answer.
        $suggestions = $best['score'] < self::CERTAIN
            ? $this->titles(array_slice($scored, 1, 3), $lang)
            : [];

        return $this->reply($reply, $lang, $suggestions);
    }

    /**
     * @param  array<string, mixed>  $entry
     * @param  array<int, string>    $tokens
     */
    private function score(array $entry, string $normalised, array $tokens): int
    {
        $phraseBonus = 0;

        // Each distinct word earns credit once, at the best weight any keyword
        // achieved for it. Without this, an entry that happens to list the same
        // common word several times outranks a genuinely more specific one.
        $wordScores = [];

        $award = function (string $word, int $weight) use (&$wordScores) {
            if ($weight > ($wordScores[$word] ?? 0)) {
                $wordScores[$word] = $weight;
            }
        };

        foreach ($entry['keywords'] as $keyword) {
            $keyword = $this->normalise($keyword);

            if ($keyword === '') {
                continue;
            }

            $words = $this->tokenise($keyword, false);

            if (! $words) {
                continue;
            }

            $verbatim = str_contains(" {$normalised} ", " {$keyword} ");

            // A multi-word phrase appearing intact is the strongest signal
            // there is, and longer phrases are stronger still.
            if ($verbatim && count($words) > 1) {
                $phraseBonus += 12 * count($words);
                continue;
            }

            foreach ($words as $word) {
                if (in_array($word, $tokens, true)) {
                    // A word that is a keyword in its own right says more
                    // about the entry than one buried inside a longer phrase.
                    $award($word, $verbatim ? 10 : 6);
                } elseif ($this->fuzzyHit($word, $tokens)) {
                    $award($word, 3);
                }
            }
        }

        // Titles are matched in both languages so a Malay title word can find
        // the entry too.
        foreach ($this->titleWords($entry) as $word) {
            if (in_array($word, $tokens, true)) {
                $award($word, 2);
            }
        }

        return $phraseBonus + array_sum($wordScores);
    }

    /**
     * @param  array<string, mixed>  $entry
     * @return array<int, string>
     */
    private function titleWords(array $entry): array
    {
        $words = [];

        foreach (self::LANGUAGES as $lang) {
            $words = array_merge($words, $this->tokenise($this->localise($entry['title'], $lang)));
        }

        return array_unique($words);
    }

    /**
     * Tolerate a typo or two, but only on words long enough that a near-miss
     * is unlikely to be a different word entirely.
     *
     * @param  array<int, string>  $tokens
     */
    private function fuzzyHit(string $word, array $tokens): bool
    {
        if (strlen($word) < 5) {
            return false;
        }

        $allowed = strlen($word) >= 8 ? 2 : 1;

        foreach ($tokens as $token) {
            if (strlen($token) >= 5 && levenshtein($word, $token) <= $allowed) {
                return true;
            }
        }

        return false;
    }

    /**
     * Build the answer, taking the user's roles into account.
     *
     * @param  array<string, mixed>  $entry
     * @param  array<int, string>    $roles
     */
    private function render(array $entry, array $roles, string $lang): string
    {
        // #========== NEWLY ADDED ============
        // An entry may carry an 'admin' block (roles, url, answer). Users holding one of those roles get the
        // admin answer and link instead -- e.g. MAS: staff go to /sk, super admins / MAS admins to /sk/indexadmin.
        if (! empty($entry['admin']['roles']) && array_intersect($entry['admin']['roles'], $roles)) {
            $entry = array_merge($entry, [
                'answer' => $entry['admin']['answer'] ?? $entry['answer'],
                'url'    => $entry['admin']['url'] ?? ($entry['url'] ?? null),
                'roles'  => [],
            ]);
        }
        // #================================

        $reply = '**' . $this->localise($entry['title'], $lang) . "**\n\n"
            . $this->localise($entry['answer'], $lang);

        $required = $entry['roles'] ?? [];

        if ($required && ! array_intersect($required, $roles)) {
            return $reply . "\n\n---\n\n" . $this->phrase('role_missing', $lang, [
                'roles' => '`' . implode('` / `', $required) . '`',
            ]);
        }

        if ($link = $this->link($entry)) {
            $reply .= "\n\n" . $this->phrase('go_there', $lang, ['link' => $link]);
        }

        return $reply;
    }

    /**
     * @param  array<string, mixed>  $entry
     */
    private function link(array $entry): ?string
    {
        $target = $entry['url'] ?? null;

        if (! $target) {
            return null;
        }

        try {
            if (! str_starts_with($target, '/') && Route::has($target)) {
                return route($target);
            }

            return url($target);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /* ------------------------------------------------------------------ */
    /* Intents the knowledge base cannot answer                            */
    /* ------------------------------------------------------------------ */

    private function smallTalk(string $q, string $lang, ?string $firstName): ?array
    {
        if (preg_match('/^(hi|hello|hey|helo|hai|salam|assalamualaikum|selamat (pagi|petang|tengahari|malam)|good (morning|afternoon|evening))\b/', $q)) {
            return $this->reply(
                $this->phrase('greeting', $lang, ['name' => $firstName ? " {$firstName}" : '']),
                $lang,
                $this->starters($lang)
            );
        }

        if (preg_match('/^(thanks|thank you|thx|terima kasih|tq|ok thanks|great thanks)\b/', $q)) {
            return $this->reply($this->phrase('thanks', $lang), $lang);
        }

        if (preg_match('/^(bye|goodbye|see you|selamat tinggal|selamat jalan)\b/', $q)) {
            return $this->reply($this->phrase('bye', $lang), $lang);
        }

        return null;
    }

    private function asksAboutOwnAccess(string $q): bool
    {
        return (bool) preg_match(
            '/\b(my (access|roles?|permissions?)'
            . '|what (access|roles?) (do i|i) (have|hold)'
            . '|akses saya|peranan saya|apa akses|apa peranan'
            . '|who am i|siapa saya)\b/',
            $q
        );
    }

    /**
     * @param  array<int, string>  $roles
     */
    private function describeAccess(array $roles, string $lang): array
    {
        if (! $roles) {
            return $this->reply($this->phrase('access_none', $lang), $lang);
        }

        sort($roles);

        $reply = $this->phrase('access_holds', $lang, ['count' => (string) count($roles)]) . "\n\n";

        foreach ($roles as $role) {
            $reply .= "- `{$role}`\n";
        }

        $unlocked = array_filter($this->entries(), function ($entry) use ($roles) {
            $required = $entry['roles'] ?? [];

            return $required && array_intersect($required, $roles);
        });

        if ($unlocked) {
            $names = array_map(fn ($entry) => $this->localise($entry['title'], $lang), $unlocked);

            $reply .= "\n" . $this->phrase('access_unlocks', $lang, [
                'services' => implode(', ', $names),
            ]);
        }

        $reply .= "\n\n" . $this->phrase('access_more', $lang);

        return $this->reply($reply, $lang);
    }

    private function asksWhatICanDo(string $q): bool
    {
        return (bool) preg_match(
            '/\b(what can you do|who are you|what are you|your (job|purpose)|how do you work'
            . '|apa (kamu|awak|anda) boleh|apa yang (kamu|awak|anda) boleh'
            . '|siapa (kamu|awak|anda)|fungsi (kamu|awak|anda))\b/',
            $q
        );
    }

    private function describeSelf(string $lang): array
    {
        $categories = [];

        foreach ($this->entries() as $entry) {
            if (! empty($entry['category'])) {
                $categories[] = $this->localise($entry['category'], $lang);
            }
        }

        return $this->reply(
            $this->phrase('self_intro', $lang, [
                'categories' => implode(', ', array_unique($categories)),
            ]),
            $lang,
            $this->starters($lang)
        );
    }

    /* ------------------------------------------------------------------ */
    /* Fallback                                                            */
    /* ------------------------------------------------------------------ */

    /**
     * @param  array<int, array{entry: array<string, mixed>, score: int}>  $scored
     */
    private function noMatch(string $lang, array $scored = []): array
    {
        $near = $this->titles(array_slice($scored, 0, 3), $lang);

        $reply = $this->phrase('no_match', $lang);

        if (! $near) {
            $reply .= "\n\n" . $this->phrase('no_match_dss', $lang);
        }

        return $this->reply($reply, $lang, $near ?: $this->starters($lang));
    }

    /* ------------------------------------------------------------------ */
    /* Helpers                                                             */
    /* ------------------------------------------------------------------ */

    /**
     * @return array<int, string>
     */
    private function starters(string $lang): array
    {
        $starters = $this->phrase('starters', $lang);

        return is_array($starters) ? $starters : [];
    }

    /**
     * @param  array<int, array{entry: array<string, mixed>, score?: int}>  $scored
     * @return array<int, string>
     */
    private function titles(array $scored, string $lang): array
    {
        return array_values(array_map(
            fn ($item) => $this->localise($item['entry']['title'], $lang),
            $scored
        ));
    }

    /**
     * @param  array<int, string>  $suggestions
     * @return array{reply: string, suggestions: array<int, string>, lang: string}
     */
    private function reply(string $reply, string $lang, array $suggestions = []): array
    {
        return ['reply' => $reply, 'suggestions' => $suggestions, 'lang' => $lang];
    }

    /**
     * Lowercase, strip punctuation, collapse whitespace.
     */
    private function normalise(string $text): string
    {
        $text = mb_strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9&\s]+/u', ' ', $text);

        return trim(preg_replace('/\s+/', ' ', $text));
    }

    /**
     * @return array<int, string>
     */
    private function tokenise(string $text, bool $dropStopwords = true): array
    {
        $words = array_filter(explode(' ', $this->normalise($text)));

        if ($dropStopwords) {
            $words = array_diff($words, self::STOPWORDS);
        }

        return array_values(array_unique($words));
    }

    /**
     * Services and FAQs, flattened into one searchable list.
     *
     * @return array<int, array<string, mixed>>
     */
    private function entries(): array
    {
        return Cache::remember('meshbot.entries', now()->addHour(), function () {
            $path = config('meshbot.knowledge_file');

            if (! is_file($path)) {
                return [];
            }

            $data = require $path;

            $entries = [];

            foreach (['services', 'faqs'] as $group) {
                foreach ($data[$group] ?? [] as $entry) {
                    $entry['category'] = $entry['category'] ?? null;
                    $entries[] = $entry;
                }
            }

            return $entries;
        });
    }

    /**
     * @return array<string, array<string, string|array<int, string>>>
     */
    private function phrases(): array
    {
        return Cache::remember('meshbot.phrases', now()->addHour(), function () {
            $path = config('meshbot.phrases_file');

            return is_file($path) ? require $path : [];
        });
    }
}
