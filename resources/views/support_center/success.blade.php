{{-- resources/views/support_center/success.blade.php --}}
<!doctype html>
<html lang="ms">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Permohonan Berjaya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  {{-- Header --}}
  <nav class="navbar navbar-dark bg-primary">
    <div class="container">
      <span class="navbar-brand mb-0 h1">
        <i class="bi bi-headset"></i> DevOps Service Desk
      </span>
    </div>
  </nav>

  {{-- Content --}}
  <div class="container py-5">
    <a href="{{ route('support-center.create') }}" class="btn btn-outline-primary mb-3">
      <i class="bi bi-arrow-left-circle"></i> Hantar Aduan Baru
    </a>

    <div class="card shadow p-5 text-center bg-white rounded-4">
      <h2 class="fw-bold text-success mb-4" style="font-size: 2rem;">
        <i class="bi bi-check-circle-fill"></i> Permohonan Berjaya Dihantar
      </h2>

      <p class="mb-5 text-center" style="font-size: 16px; line-height: 1.8;">
        {!! nl2br(e($message)) !!}
      </p>

      <h4 class="mt-5 fw-bold text-uppercase">
        Tiket Aduan:
        <span class="badge bg-primary px-3 py-2" style="font-size: 1.2rem;">
          {{ $ticketId }}
        </span>
      </h4>
    </div>
  </div>

  {{-- Footer --}}
  <footer class="text-center py-3 mt-5 bg-primary text-white">
    <small>© {{ date('Y') }} DevOps Service Desk</small>
  </footer>

</body>
</html>
