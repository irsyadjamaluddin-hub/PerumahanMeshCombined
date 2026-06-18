<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'GenAI Guidance For Education')</title>

  {{-- Bootstrap CSS via CDN (no local assets needed) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --brand:#4154f1;
      --bg:#f6f9ff;
      --card:#ffffff;
      --border:#e9eefc;
      --shadow:0 6px 14px rgba(65,84,241,.06);
    }
    body{ background:var(--bg); }
    .container-narrow{ max-width:1100px; }
    header.hero{
      background: radial-gradient(1000px 600px at 10% -20%, #dfe5ff 0%, rgba(223,229,255,0) 60%),
                  linear-gradient(135deg, #eef2ff 0%, #ffffff 100%);
      border-bottom:1px solid var(--border);
    }
    .title{ font-weight:700; letter-spacing:.2px; }
    .card{ border:1px solid var(--border); box-shadow:var(--shadow); }
    .btn-primary{ background:var(--brand); border-color:var(--brand); }
    .toolbar { gap:.5rem; }
  </style>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <header class="hero">
    <div class="container container-narrow py-4 d-flex align-items-center justify-content-between flex-wrap">
      <div class="d-flex align-items-center gap-3">
        <span class="rounded-circle d-inline-flex align-items-center justify-content-center"
              style="width:40px;height:40px;background:#e9edff;color:var(--brand);">
          {{-- inline doc icon --}}
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM14 3.5L19.5 9H14V3.5zM8 12h8v2H8v-2zm0 4h8v2H8v-2zM8 8h4v2H8V8z"/>
          </svg>
        </span>
        <div>
          <div class="title h4 mb-0">@yield('title', 'GenAI Handbook')</div>
        </div>
      </div>
      <div class="toolbar d-flex">
        @yield('header-actions')
      </div>
    </div>
  </header>

  <main class="container container-narrow py-4">
    @yield('content')
  </main>

  <footer class="py-4">
    <div class="container container-narrow text-center text-muted small">
      © {{ now()->year }}
    </div>
  </footer>

  {{-- Bootstrap JS (optional; page works without it) --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
