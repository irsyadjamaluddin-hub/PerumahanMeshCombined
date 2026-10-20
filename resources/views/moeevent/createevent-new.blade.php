{{-- #==== ORI CODE ====
@extends('layouts.app-all')

@section('title', 'Create Event')

@section('content')

<?php
$pagename = "Event";
?>
--}}

{{-- #==== NEWLY ADDED ==== --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MEA - Create Event</title>

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <style>
    * { box-sizing: border-box; }

    p { font-size: 14px; margin: 0 0 8px; }

    html, body { height: 100%; }

    body {
      margin: 0;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
      background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.12) 1px, transparent 1.4px),
        radial-gradient(ellipse 900px 600px at 20% 10%, rgba(79, 70, 229, 0.35), transparent 60%),
        radial-gradient(ellipse 800px 700px at 85% 85%, rgba(206, 17, 38, 0.18), transparent 55%),
        linear-gradient(150deg, #0f0b2e 0%, #140f34 45%, #201a5c 100%);
      background-size: 22px 22px, cover, cover, cover;
      background-position: 0 0, center, center, center;
      background-repeat: repeat, no-repeat, no-repeat, no-repeat;
      background-attachment: fixed;
      font-family: -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      display: flex;
      /* #==== ORI CODE ====
      align-items: center;
      */
      /* #==== NEWLY ADDED (top-align so tall forms never clip on short/laptop viewports) ==== */
      align-items: flex-start;
      justify-content: center;
      padding: 40px 16px;
    }

    #particles-js {
      position: fixed;
      inset: 0;
      z-index: 0;
    }

    /* #==== ORI CODE ====
    .back-link {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 2;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 999px;
      border: 1.5px solid rgba(255, 255, 255, 0.55);
      color: #ffffff;
      text-decoration: none;
      font-size: 18px;
      transition: background-color 0.2s ease, color 0.2s ease;
    }

    .back-link:hover { background: #ffffff; color: #0c2f5e; }
    */

    /* #==== NEWLY ADDED (solid blue button, in-flow above the card, matching the sk page's back button) ==== */
    .page-col {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 680px;
      display: flex;
      flex-direction: column;
    }

    .back-link {
      align-self: flex-start;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: #0c2f5e;
      /* #==== NEWLY ADDED (white border for visibility) ==== */
      border: 1.5px solid #ffffff;
      color: #ffffff;
      text-decoration: none;
      font-size: 18px;
      margin-bottom: 12px;
      transition: background-color 0.2s ease;
    }

    .back-link:hover { background: #144d8f; }

    .card {
      width: 100%;
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 20px 45px rgba(4, 18, 40, 0.45);
      padding: 32px 36px 36px;
    }

    /* #==== NEWLY ADDED ==== */
    .logo-row { text-align: center; margin-bottom: 18px; }
    .moe-logo { max-width: 190px; width: 60%; height: auto; margin: 0 auto; }

    .title-row { text-align: center; }

    .card-title {
      display: inline-block;
      font-weight: 700;
      font-size: 18px;
      color: #0c2f5e;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      padding-bottom: 10px;
      position: relative;
    }

    .card-title::after {
      content: "";
      position: absolute;
      left: 50%;
      bottom: 0;
      width: 46px;
      height: 3px;
      border-radius: 2px;
      background: #f0b429;
      transform: translateX(-50%);
    }

    hr { border: none; border-top: 1px solid rgba(12, 47, 94, 0.12); margin: 18px 0 22px; }

    .alert {
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 13.5px;
      margin-bottom: 16px;
    }

    .alert-danger { background: #fdecec; color: #b42318; border: 1px solid #f7c6c2; }
    .alert-danger ul { margin: 6px 0 0; padding-left: 18px; }

    .field-row {
      display: flex;
      gap: 16px;
      align-items: flex-start;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .field-label {
      flex: 0 0 160px;
      padding-top: 9px;
      font-weight: 600;
      font-size: 14px;
      color: #4a90d9;
    }

    .field-label .req { color: #dc2626; margin-left: 2px; }

    .field-control { flex: 1 1 260px; }

    /* #==========ORI CODE=========
    input {
      width: 100%;
      font: inherit;
      font-size: 14px;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      padding: 10px 14px;
      color: #1f2d3d;
      background: #e6f1fb;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    #==========NEWLY ADDED======== */
    /* #==========ORI CODE=========
    input {
      width: 100%;
      font: inherit;
      font-size: 14px;
      border: 1.5px solid #c9def2;
      border-radius: 8px;
      padding: 10px 14px;
      color: #000000;
      background: #e6f1fb;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    #==========NEWLY ADDED======== (darker field background/border, matching the DRF form) */
    input {
      width: 100%;
      font: inherit;
      font-size: 14px;
      border: 1.5px solid #a9c9e8;
      border-radius: 8px;
      padding: 10px 14px;
      color: #000000;
      background: #cfe2f5;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    /* =========================== */

    /* #==========NEWLY ADDED======== (browser dims ::placeholder text by default regardless of the input's own color) */
    ::placeholder { color: #000000; opacity: 1; }
    /* =========================== */

    /* #==========NEWLY ADDED======== (Chrome's autofill/autocomplete-suggestion styling uses -webkit-text-fill-color, which overrides the plain color property, and needs !important on every autofill pseudo-class or Chrome's own internal autofill style still wins — this is why a value picked from the browser's suggestion dropdown rendered gray while manually-typed text stayed black) */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
      -webkit-text-fill-color: #000000 !important;
      -webkit-box-shadow: 0 0 0 1000px #cfe2f5 inset !important;
      box-shadow: 0 0 0 1000px #cfe2f5 inset !important;
      caret-color: #000000;
      transition: background-color 5000s ease-in-out 0s;
    }
    /* =========================== */

    input:focus {
      outline: none;
      border-color: #144d8f;
      box-shadow: 0 0 0 4px rgba(20, 77, 143, 0.15);
    }

    input[readonly] {
      background: #eef2fb;
      color: #5b6188;
      cursor: not-allowed;
    }

    .submit-row { text-align: center; margin-top: 24px; }

    button[type="submit"] {
      background: #0c2f5e;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 36px;
      font: inherit;
      font-weight: 600;
      font-size: 15px;
      letter-spacing: 0.3px;
      cursor: pointer;
      transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    button[type="submit"]:hover { background: #144d8f; transform: translateY(-1px); box-shadow: 0 10px 20px rgba(4, 18, 40, 0.3); }
    button[type="submit"]:focus { box-shadow: 0 0 0 4px rgba(240, 180, 41, 0.35); }

    @media (max-width: 560px) {
      body { padding: 24px 12px; }

      .card { padding: 24px 20px 28px; border-radius: 14px; }

      .card-title { font-size: 16px; }

      .field-row { flex-direction: column; gap: 6px; }

      .field-label { flex: none; padding-top: 0; }

      /* #==== NEWLY ADDED (260px flex-basis is read as a forced HEIGHT once flex-direction is column, leaving a blank box under each field) ==== */
      .field-control { flex: 1 1 auto; }

      input { font-size: 16px; }

      button[type="submit"] { width: 100%; }
    }
  </style>
</head>

<body>

  <div id="particles-js"></div>

  <div class="page-col">
    <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="back-link">&larr;</a>

  <div class="card">
    {{-- #==== NEWLY ADDED ==== --}}
    <div class="logo-row">
      <img src="{{ asset('img/moe-logo-latest-compressed.png') }}" alt="MOE Logo" class="moe-logo">
    </div>

    <div class="title-row">
      <header class="card-title">Create Event</header>
    </div>
    <hr>

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        Upload Validation Error
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="post" action="{{ route('moeevent.moeevent.storeevent') }}" enctype="multipart/form-data">
      @csrf

      <div class="field-row">
        <label class="field-label">Event<span class="req">*</span></label>
        <div class="field-control">
          <input type="text" name="eventlabel" required>
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Event Date<span class="req">*</span></label>
        <div class="field-control">
          <input type="date" name="eventdate" required>
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Event Date End<span class="req">*</span></label>
        <div class="field-control">
          <input type="date" name="eventdateend" required>
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Event Time<span class="req">*</span></label>
        <div class="field-control">
          <input type="time" name="eventtime" required>
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Event Venue<span class="req">*</span></label>
        <div class="field-control">
          <input type="text" name="eventvenue" required>
        </div>
      </div>

      <div class="field-row">
        <label class="field-label">Jabatan</label>
        <div class="field-control">
          @foreach ($employments as $employment)
            <input type="text" name="jabatan" value="{{ optional($employment->department)->label }}" readonly>
            <input type="hidden" name="jabatan" value="{{ $employment->department_id }}">
          @endforeach
        </div>
      </div>

      @foreach ($biodatas as $biodata)
        <div class="field-row">
          <label class="field-label">Nama</label>
          <div class="field-control">
            <input type="text" name="nama" value="{{ $biodata->name }}" readonly>
          </div>
        </div>

        <div class="field-row">
          <label class="field-label">IC No.</label>
          <div class="field-control">
            <input type="text" name="icno" value="{{ $biodata->ic_no }}" readonly>
          </div>
        </div>
      @endforeach

      <div class="submit-row">
        <button id="submit-button" type="submit">Submit</button>
      </div>
    </form>
  </div>
  </div>

  {{-- Particles JS --}}
  <script src="{{ asset('js/particles.min.js') }}"></script>
  <script>
    particlesJS("particles-js", {"particles":{"number":{"value":100,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
  </script>

</body>
</html>

{{-- #==== ORI CODE ====
@endsection
--}}
