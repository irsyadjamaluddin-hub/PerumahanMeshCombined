{{--
    MESH Smart Bot — floating assistant, included from every layout.

    Self-contained on purpose: scoped class names, its own CSS, and plain
    JavaScript with no jQuery/Bootstrap/Tailwind dependency, because the
    layouts that include it do not agree on which of those are loaded.

    English and Malay. The bot detects the language of each question and
    replies in kind; the header toggle pins one language when a user would
    rather not rely on detection. All wording lives in
    resources/meshbot/phrases.php.
--}}

@auth
@if (config('meshbot.enabled'))

@php
    $meshbot = app(App\Services\SmartBot\SmartBotResponder::class)
        ->widgetStrings(explode(' ', trim(Auth::user()->name ?? ''))[0] ?: null);
@endphp

<div id="meshbot" data-endpoint="{{ route('smartbot.chat') }}" data-token="{{ csrf_token() }}">

    <button type="button" id="meshbot-launcher" aria-expanded="false">
        <img src="{{ asset('images/meshbot/mascot.png') }}" alt="" id="meshbot-launcher-icon">
    </button>

    <section id="meshbot-panel" role="dialog" aria-label="{{ config('meshbot.name') }}" aria-modal="false" hidden>

        <header id="meshbot-header">
            <img src="{{ asset('images/meshbot/mascot.png') }}" alt="" id="meshbot-header-icon">
            <div>
                <p id="meshbot-title">{{ config('meshbot.name') }}</p>
                <p id="meshbot-subtitle"></p>
            </div>
            <div id="meshbot-actions">
                <button type="button" id="meshbot-lang"></button>
                <button type="button" id="meshbot-reset">
                    <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 2v6h6"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L3 8"/>
                    </svg>
                </button>
                <button type="button" id="meshbot-close">
                    <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>
        </header>

        <div id="meshbot-log" role="log" aria-live="polite" aria-atomic="false"></div>

        <form id="meshbot-form" autocomplete="off">
            <textarea id="meshbot-input" rows="1" maxlength="{{ config('meshbot.max_message_length') }}"></textarea>
            <button type="submit" id="meshbot-send">
                <svg viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4 20-7z"/>
                </svg>
            </button>
        </form>

    </section>
</div>

<style>
#meshbot, #meshbot * { box-sizing: border-box; }

#meshbot {
    position: fixed;
    right: 20px;
    bottom: 20px;
    z-index: 2147483000;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    font-size: 14px;
    line-height: 1.55;
    color: #1f2937;
}

#meshbot-launcher {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    width: 68px;
    height: 68px;
    margin-left: auto;
    padding: 0;
    border: 0;
    border-radius: 50%;
    background: #2563eb;
    color: #fff;
    cursor: pointer;
    box-shadow: 0 8px 24px rgba(37, 99, 235, .38);
    transition: transform .18s ease, background .18s ease;
}
#meshbot-launcher:hover { background: #1d4ed8; transform: translateY(-2px); }
#meshbot-launcher:focus-visible { outline: 3px solid #93c5fd; outline-offset: 2px; }

#meshbot-launcher-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    object-fit: cover;
    pointer-events: none;
}

#meshbot-panel {
    display: flex;
    flex-direction: column;
    width: 380px;
    height: 540px;
    max-height: calc(100vh - 120px);
    margin-bottom: 14px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 20px 48px rgba(15, 23, 42, .22);
}
#meshbot-panel[hidden] { display: none; }

#meshbot-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 14px 16px;
    background: #2563eb;
    color: #fff;
}
#meshbot-header-icon {
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
#meshbot-header > div { flex: 1; min-width: 0; }
#meshbot-title { margin: 0; font-size: 15px; font-weight: 700; }
#meshbot-subtitle { margin: 2px 0 0; font-size: 12px; opacity: .8; }

#meshbot-actions { display: flex; align-items: center; gap: 4px; }
#meshbot-actions button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    padding: 0;
    border: 0;
    border-radius: 8px;
    background: transparent;
    color: #fff;
    font: inherit;
    cursor: pointer;
    opacity: .85;
}
#meshbot-actions button:hover { background: rgba(255, 255, 255, .18); opacity: 1; }

#meshbot-lang {
    width: auto !important;
    min-width: 34px;
    padding: 0 7px !important;
    border: 1px solid rgba(255, 255, 255, .45) !important;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .3px;
}
#meshbot-lang[data-pinned="1"] { background: #fff; color: #2563eb; opacity: 1; }

#meshbot-log {
    flex: 1;
    padding: 16px;
    overflow-y: auto;
    background: #f8fafc;
}

.meshbot-msg {
    max-width: 88%;
    margin-bottom: 12px;
    padding: 9px 13px;
    border-radius: 14px;
    white-space: normal;
    overflow-wrap: anywhere;
}
.meshbot-msg-user {
    margin-left: auto;
    border-bottom-right-radius: 4px;
    background: #2563eb;
    color: #fff;
}
.meshbot-msg-bot {
    margin-right: auto;
    border: 1px solid #e5e7eb;
    border-bottom-left-radius: 4px;
    background: #fff;
}
.meshbot-msg-error {
    margin-right: auto;
    border: 1px solid #fecaca;
    background: #fef2f2;
    color: #b91c1c;
}

.meshbot-msg p { margin: 0 0 8px; }
.meshbot-msg p:last-child { margin-bottom: 0; }
.meshbot-msg ul, .meshbot-msg ol { margin: 0 0 8px; padding-left: 20px; }
.meshbot-msg li { margin-bottom: 3px; }
.meshbot-msg hr { margin: 10px 0; border: 0; border-top: 1px solid #e5e7eb; }
.meshbot-msg code {
    padding: 1px 5px;
    border-radius: 4px;
    background: rgba(148, 163, 184, .22);
    font-family: ui-monospace, Menlo, Consolas, monospace;
    font-size: .9em;
}
.meshbot-msg-user code { background: rgba(255, 255, 255, .25); }
.meshbot-msg a { color: #2563eb; text-decoration: underline; overflow-wrap: anywhere; }
.meshbot-msg-user a { color: inherit; }

.meshbot-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin: -4px 0 14px;
}
.meshbot-chip {
    padding: 5px 11px;
    border: 1px solid #bfdbfe;
    border-radius: 999px;
    background: #eff6ff;
    color: #1d4ed8;
    font: inherit;
    font-size: 12.5px;
    cursor: pointer;
    transition: background .15s ease;
}
.meshbot-chip:hover { background: #dbeafe; }

#meshbot-typing { display: flex; gap: 4px; align-items: center; padding: 12px 14px; }
#meshbot-typing span {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #94a3b8;
    animation: meshbot-bounce 1.3s infinite ease-in-out;
}
#meshbot-typing span:nth-child(2) { animation-delay: .16s; }
#meshbot-typing span:nth-child(3) { animation-delay: .32s; }
@keyframes meshbot-bounce {
    0%, 70%, 100% { transform: translateY(0); opacity: .5; }
    35%           { transform: translateY(-5px); opacity: 1; }
}

#meshbot-form {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    padding: 10px 12px;
    border-top: 1px solid #e5e7eb;
    background: #fff;
}
#meshbot-input {
    flex: 1;
    max-height: 110px;
    padding: 9px 12px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    background: #fff;
    color: inherit;
    font: inherit;
    resize: none;
}
#meshbot-input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, .15); }

#meshbot-send {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
    width: 38px;
    height: 38px;
    padding: 0;
    border: 0;
    border-radius: 10px;
    background: #2563eb;
    color: #fff;
    cursor: pointer;
}
#meshbot-send:hover:not(:disabled) { background: #1d4ed8; }
#meshbot-send:disabled { opacity: .45; cursor: not-allowed; }

@media (max-width: 480px) {
    #meshbot { right: 12px; bottom: 12px; left: 12px; }
    #meshbot-panel { width: auto; height: calc(100vh - 110px); }
}

@media print { #meshbot { display: none; } }

/* The admin templates park a back-to-top button at right:15/bottom:15, which
   sits underneath the launcher. Lift it clear. */
.back-to-top { bottom: 88px !important; }
</style>

<script>
(function () {
    "use strict";

    var root = document.getElementById("meshbot");
    if (!root) { return; }

    var ENDPOINT   = root.dataset.endpoint;
    var TOKEN      = root.dataset.token;
    var STORE_KEY  = "meshbot.transcript";
    var LANG_KEY   = "meshbot.lang";
    var MAX_TURNS  = {{ (int) config('meshbot.history_limit') }};
    var MESHBOT    = {!! Illuminate\Support\Js::from($meshbot) !!};

    // "" means auto-detect per question; "en" / "ms" pin the reply language.
    var pinned = "";

    var launcher = document.getElementById("meshbot-launcher");
    var panel    = document.getElementById("meshbot-panel");
    var log      = document.getElementById("meshbot-log");
    var form     = document.getElementById("meshbot-form");
    var input    = document.getElementById("meshbot-input");
    var send     = document.getElementById("meshbot-send");
    var langBtn  = document.getElementById("meshbot-lang");
    var busy     = false;

    /* ---------- language ---------- */

    // Which language the widget's own labels use. In auto mode that is the
    // server's default; once pinned it follows the pin.
    function uiLang() {
        return pinned || MESHBOT.default;
    }

    function t(key) {
        var entry = MESHBOT.strings[key];
        return (entry && (entry[uiLang()] || entry.en)) || "";
    }

    function starters() {
        return MESHBOT.starters[uiLang()] || MESHBOT.starters.en || [];
    }

    function loadLang() {
        try {
            var saved = sessionStorage.getItem(LANG_KEY);
            return (saved === "en" || saved === "ms") ? saved : "";
        } catch (e) {
            return "";
        }
    }

    function saveLang() {
        try { sessionStorage.setItem(LANG_KEY, pinned); } catch (e) { /* ignore */ }
    }

    // Auto -> EN -> BM -> Auto
    function cycleLang() {
        pinned = pinned === "" ? "en" : (pinned === "en" ? "ms" : "");
        saveLang();
        applyLabels();
        paint();
    }

    function applyLabels() {
        langBtn.textContent = pinned === "" ? t("auto_label") : (pinned === "en" ? "EN" : "BM");
        langBtn.dataset.pinned = pinned === "" ? "0" : "1";
        langBtn.setAttribute("aria-label", t("language"));
        langBtn.title = t("language");

        document.getElementById("meshbot-subtitle").textContent = t("subtitle");
        input.placeholder = t("placeholder");
        input.setAttribute("aria-label", t("question"));

        launcher.setAttribute("aria-label", t("open"));
        send.setAttribute("aria-label", t("send"));
        send.title = t("send");

        var reset = document.getElementById("meshbot-reset");
        reset.setAttribute("aria-label", t("reset"));
        reset.title = t("reset");

        var close = document.getElementById("meshbot-close");
        close.setAttribute("aria-label", t("close"));
        close.title = t("close");
    }

    /* ---------- transcript (kept for the browser session, across page loads) ---------- */

    function loadTranscript() {
        try {
            var raw = sessionStorage.getItem(STORE_KEY);
            var parsed = raw ? JSON.parse(raw) : [];
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            return [];
        }
    }

    function saveTranscript() {
        try {
            sessionStorage.setItem(STORE_KEY, JSON.stringify(transcript.slice(-MAX_TURNS)));
        } catch (e) { /* private mode or quota — the chat still works, just not across pages */ }
    }

    var transcript = loadTranscript();

    /* ---------- rendering ---------- */

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;");
    }

    // Deliberately tiny: escape everything first, then re-introduce only the
    // handful of constructs the knowledge file is allowed to use.
    function renderMarkdown(text) {
        var lines = escapeHtml(text).split(/\r?\n/);
        var html = "";
        var listTag = null;
        var paragraph = [];

        function flushParagraph() {
            if (paragraph.length) {
                html += "<p>" + paragraph.join("<br>") + "</p>";
                paragraph = [];
            }
        }

        function closeList() {
            if (listTag) { html += "</" + listTag + ">"; listTag = null; }
        }

        function openList(tag) {
            if (listTag !== tag) { closeList(); html += "<" + tag + ">"; listTag = tag; }
        }

        lines.forEach(function (line) {
            var bullet  = line.match(/^\s*[-*]\s+(.*)$/);
            var ordered = line.match(/^\s*\d+[.)]\s+(.*)$/);

            if (/^\s*---+\s*$/.test(line)) {
                flushParagraph();
                closeList();
                html += "<hr>";
            } else if (bullet) {
                flushParagraph();
                openList("ul");
                html += "<li>" + inline(bullet[1]) + "</li>";
            } else if (ordered) {
                flushParagraph();
                openList("ol");
                html += "<li>" + inline(ordered[1]) + "</li>";
            } else if (line.trim() === "") {
                flushParagraph();
                closeList();
            } else {
                closeList();
                paragraph.push(inline(line.trim()));
            }
        });

        flushParagraph();
        closeList();
        return html;
    }

    function inline(text) {
        return text
            .replace(/`([^`]+)`/g, "<code>$1</code>")
            .replace(/\*\*([^*]+)\*\*/g, "<strong>$1</strong>")
            .replace(/\*([^*]+)\*/g, "<em>$1</em>")
            .replace(/(^|[\s(])(https?:\/\/[^\s<)]+)/g,
                     '$1<a href="$2" target="_blank" rel="noopener noreferrer">$2</a>');
    }

    function scrollToBottom() {
        log.scrollTop = log.scrollHeight;
    }

    function appendMessage(role, text) {
        var el = document.createElement("div");
        el.className = "meshbot-msg meshbot-msg-" + role;

        if (role === "user") {
            el.textContent = text;
        } else {
            el.innerHTML = renderMarkdown(text);
        }

        log.appendChild(el);
        scrollToBottom();
    }

    function appendChips(labels) {
        if (!labels || !labels.length) { return; }

        var wrap = document.createElement("div");
        wrap.className = "meshbot-chips";

        labels.forEach(function (label) {
            var chip = document.createElement("button");
            chip.type = "button";
            chip.className = "meshbot-chip";
            chip.textContent = label;
            chip.addEventListener("click", function () {
                if (busy) { return; }
                wrap.remove();
                ask(label);
            });
            wrap.appendChild(chip);
        });

        log.appendChild(wrap);
        scrollToBottom();
    }

    function showTyping() {
        var el = document.createElement("div");
        el.className = "meshbot-msg meshbot-msg-bot";
        el.id = "meshbot-typing";
        el.innerHTML = "<span></span><span></span><span></span>";
        log.appendChild(el);
        scrollToBottom();
        return el;
    }

    function paint() {
        log.innerHTML = "";

        // The opening message is the widget's own, so it follows the toggle.
        // Anything already said stays in the language it was said in.
        if (!transcript.length) {
            appendMessage("bot", t("opening"));
            appendChips(starters());
            return;
        }

        transcript.forEach(function (turn) {
            appendMessage(turn.role, turn.text);

            if (turn.role === "bot") {
                appendChips(turn.chips);
            }
        });
    }

    function record(role, text, chips) {
        transcript.push({ role: role, text: text, chips: chips || [] });
        transcript = transcript.slice(-MAX_TURNS);
        saveTranscript();
    }

    /* ---------- panel ---------- */

    function open() {
        panel.hidden = false;
        launcher.setAttribute("aria-expanded", "true");
        scrollToBottom();
        input.focus();
    }

    function close() {
        panel.hidden = true;
        launcher.setAttribute("aria-expanded", "false");
    }

    launcher.addEventListener("click", function () {
        panel.hidden ? open() : close();
    });

    langBtn.addEventListener("click", cycleLang);

    document.getElementById("meshbot-close").addEventListener("click", close);

    document.getElementById("meshbot-reset").addEventListener("click", function () {
        transcript = [];
        saveTranscript();
        paint();
        input.focus();
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && !panel.hidden) { close(); }
    });

    /* ---------- composing ---------- */

    input.addEventListener("input", function () {
        input.style.height = "auto";
        input.style.height = Math.min(input.scrollHeight, 110) + "px";
    });

    input.addEventListener("keydown", function (e) {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            form.requestSubmit ? form.requestSubmit() : form.dispatchEvent(new Event("submit", { cancelable: true }));
        }
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        var message = input.value.trim();
        if (!message || busy) { return; }

        input.value = "";
        input.style.height = "auto";
        ask(message);
    });

    /* ---------- asking ---------- */

    function setBusy(state) {
        busy = state;
        send.disabled = state;
        input.disabled = state;
    }

    function ask(message) {
        appendMessage("user", message);
        record("user", message);
        setBusy(true);

        var typing = showTyping();
        var body = { message: message };

        if (pinned) { body.lang = pinned; }

        fetch(ENDPOINT, {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": TOKEN,
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify(body)
        })
        .then(function (res) {
            return res.json()
                .catch(function () { return {}; })
                .then(function (data) { return { ok: res.ok, status: res.status, data: data }; });
        })
        .then(function (result) {
            typing.remove();

            if (!result.ok || !result.data.reply) {
                appendMessage("error", result.data.error || describeStatus(result.status));
                return;
            }

            appendMessage("bot", result.data.reply);
            appendChips(result.data.suggestions);
            record("bot", result.data.reply, result.data.suggestions);
        })
        .catch(function () {
            typing.remove();
            appendMessage("error", t("error_network"));
        })
        .then(function () {
            setBusy(false);
            input.focus();
        });
    }

    function describeStatus(status) {
        if (status === 419) { return t("error_session"); }
        if (status === 429) { return t("error_rate"); }
        if (status === 401 || status === 403) { return t("error_auth"); }
        return t("error_generic");
    }

    pinned = loadLang();
    applyLabels();
    paint();
})();  
</script>

@endif
@endauth
