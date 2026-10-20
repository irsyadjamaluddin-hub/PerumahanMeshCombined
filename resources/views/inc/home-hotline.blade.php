{{-- =============== NISAH =============== --}}
{{-- DevOps Hotline strip (3 Oct 2026, "Option A"): slim bar between the greeting card and Services on MESH Home --}}
{{-- (home.blade.php) and PDMS Home (pdmshome.blade.php). The hotline is WhatsApp only (no calls): the number and the --}}
{{-- WhatsApp button both open a chat with a message already typed. Support Request opens the existing #permohonanModal --}}
{{-- from inc/home-services. --}}
{{-- Preview: https://claude.ai/artifact/KNotirQmmoAaVFLfEyA9aa --}}
{{-- =============================================== --}}
  <?php
    /* =============== NISAH =============== */
    // >>> EDIT THESE before deploying: the values below are PLACEHOLDERS. <<<
    // The hotline is WhatsApp only, there is no call line.
    // $hotlineDisplay  = number as shown on screen
    // $hotlineWhatsapp = same number for the WhatsApp link: 673 + 7 digits, no +, spaces or dashes
    $hotlineDisplay  = '+673 873 9123';
    $hotlineWhatsapp = '6738739123';
    $hotlineHours    = 'Mon–Thu, Sat · 7:45 am – 4:30 pm';

    // first WhatsApp message, with the user's name so DevOps knows who is asking
    $hotlineWaText = 'Hi DevOps, I need help with MESH. Name: ' . optional(Auth::user())->display_name;
    /* =============================================== */
  ?>

    <style>
      /* =============== NISAH =============== */
      /* Hotline strip: same white card look as the service cards (inc/home-greeting styles) */
      .home-hotline{
        display:flex; align-items:center; gap:14px; flex-wrap:wrap;
        background:#fff; border:1px solid #e6e9f2; border-radius:13px; padding:12px 16px; margin:-8px 0 28px;
        box-shadow:0 1px 3px rgba(30,64,175,.06);
      }
      .home-hotline-icon{
        width:40px; height:40px; border-radius:11px; flex:none;
        background:#1a7f4b; color:#fff; /* WhatsApp green: the hotline is WhatsApp only */ display:flex; align-items:center; justify-content:center; font-size:18px;
      }
      .home-hotline-text{ display:flex; flex-direction:column; min-width:0; }
      .home-hotline-label{ font-size:11.5px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#5b6188; }
      .home-hotline-line{ display:flex; align-items:baseline; flex-wrap:wrap; gap:4px 8px; }
      .home-hotline-num{
        font-size:18px; font-weight:700; letter-spacing:.02em; color:#1c1934; font-variant-numeric:tabular-nums;
        text-decoration:none; border-bottom:1px dotted currentColor;
      }
      .home-hotline-num:hover{ color:#1c1934; border-bottom-style:solid; }
      .home-hotline-hours{ font-size:13px; color:#5b6188; }
      .home-hotline-actions{ margin-left:auto; display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
      .home-hotline-btn{
        display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:600; line-height:1;
        padding:8px 14px; border-radius:8px; border:0; text-decoration:none; cursor:pointer;
      }
      .home-hotline-btn--wa{ background:#1a7f4b; color:#fff; }
      .home-hotline-btn--wa:hover{ background:#156b3f; color:#fff; }
      .home-hotline-btn--support{ background:#F7E9E6; color:#A24638; }
      .home-hotline-btn--support:hover{ background:#f0dcd7; color:#A24638; }
      .home-hotline-btn:focus-visible, .home-hotline-num:focus-visible{ outline:2px solid #1e40af; outline-offset:2px; }
      @media (max-width:760px){
        .home-hotline-actions{ margin-left:0; width:100%; }
      }
      /* =============================================== */
    </style>

    {{-- =============== NISAH =============== --}}
    {{-- DevOps Hotline strip (Option A) --}}
    <section class="home-hotline" aria-label="DevOps Hotline">
      <span class="home-hotline-icon" aria-hidden="true"><i class="bi bi-whatsapp"></i></span>
      <div class="home-hotline-text">
        <span class="home-hotline-label">Need help with MESH? DevOps WhatsApp Hotline</span>
        <span class="home-hotline-line">
          {{-- WhatsApp only, no calls: the number opens the same WhatsApp chat as the button --}}
          <a class="home-hotline-num" href="https://wa.me/{{ $hotlineWhatsapp }}?text={{ rawurlencode($hotlineWaText) }}" target="_blank" rel="noopener" title="Chat on WhatsApp (messages only, no calls)">{{ $hotlineDisplay }}</a>
          <span class="home-hotline-hours">&middot; WhatsApp messages only, no calls</span>
          @if($hotlineHours)
            <span class="home-hotline-hours">&middot; {{ $hotlineHours }}</span>
          @endif
        </span>
      </div>
      <div class="home-hotline-actions">
        <a class="home-hotline-btn home-hotline-btn--wa" href="https://wa.me/{{ $hotlineWhatsapp }}?text={{ rawurlencode($hotlineWaText) }}" target="_blank" rel="noopener">
          <i class="bi bi-whatsapp"></i>Chat on WhatsApp
        </a>
        {{-- opens the same Support Request popup (DSS / DRF) as the card in Facilities & Support --}}
        <button type="button" class="home-hotline-btn home-hotline-btn--support" data-bs-toggle="modal" data-bs-target="#permohonanModal">
          <i class="bi bi-file-code"></i>Support Request
        </button>
      </div>
    </section>
    {{-- =============================================== --}}
