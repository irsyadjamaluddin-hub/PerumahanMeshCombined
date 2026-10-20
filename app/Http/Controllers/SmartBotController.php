<?php

namespace App\Http\Controllers;

use App\Services\SmartBot\SmartBotResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Backend for the MESH Smart Bot widget (resources/views/inc/smartbot.blade.php).
 *
 * Answers are produced on this server by SmartBotResponder, matching the
 * question against resources/meshbot/knowledge.php. Nothing leaves the network
 * and there is no API key to manage.
 */
class SmartBotController extends Controller
{
    public function chat(Request $request, SmartBotResponder $responder)
    {
        if (! config('meshbot.enabled')) {
            return response()->json(['error' => 'The assistant is turned off.'], 503);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:' . config('meshbot.max_message_length'),
            // Omit to let the bot detect the language from the question.
            'lang'    => 'nullable|string|in:' . implode(',', SmartBotResponder::LANGUAGES),
        ]);

        $user = Auth::user();

        $answer = $responder->answer(
            $validated['message'],
            $this->rolesOf($user),
            $this->firstNameOf($user),
            $validated['lang'] ?? null
        );

        return response()->json($answer);
    }

    /**
     * @return array<int, string>
     */
    private function rolesOf($user): array
    {
        if (! $user) {
            return [];
        }

        try {
            return $user->roles()->pluck('name')->filter()->values()->all();
        } catch (\Throwable $e) {
            Log::warning('MESH Smart Bot: could not read user roles.', ['exception' => $e->getMessage()]);

            return [];
        }
    }

    private function firstNameOf($user): ?string
    {
        $name = trim((string) ($user->name ?? ''));

        return $name === '' ? null : explode(' ', $name)[0];
    }
}
