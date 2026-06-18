@extends('layouts.genpublic')
@section('title', 'GenAI Guidance For Education')

@section('header-actions')
  <a href="{{ $pdfDownloadUrl }}" class="btn btn-primary d-inline-flex align-items-center">
    {{-- inline download icon --}}
    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
      <path d="M5 20h14v-2H5v2zm7-18v10.586l3.293-3.293 1.414 1.414L12 17.414l-4.707-4.707 1.414-1.414L11 12.586V2h1z"/>
    </svg>
    Download Handbook
  </a>
@endsection

@section('content')
<div class="card mb-3">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h5 class="card-title mb-0">Preview</h5>
      <button id="btnFullscreen" type="button" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center">
        {{-- inline fullscreen icon --}}
        <svg class="me-1" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M7 3H3v4h2V5h2V3zm14 0h-4v2h2v2h2V3zM5 17H3v4h4v-2H5v-2zm16 0h-2v2h-2v2h4v-4z"/>
        </svg>
        Fullscreen
      </button>
    </div>

    {{-- Hide native toolbar where supported --}}
    <div id="viewerBox" class="ratio" style="--bs-aspect-ratio:0%; height:80vh;">
      <iframe
        id="pdfFrame"
        src="{{ $pdfInlineUrl }}#toolbar=0"
        style="width:100%;height:100%;border:0"
        allow="fullscreen"
      ></iframe>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const box = document.getElementById('viewerBox');
  const btn = document.getElementById('btnFullscreen');
  btn.addEventListener('click', () => {
    if (document.fullscreenElement) return document.exitFullscreen?.();
    box.requestFullscreen?.() || box.webkitRequestFullscreen?.() || box.msRequestFullscreen?.();
  });
});
</script>
@endsection
