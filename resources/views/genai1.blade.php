@extends('layouts.app-all')
@section('title', 'GenAI Handbook Report')

@section('content')
@php $pagename = "GenAI Report"; @endphp

<div class="pagetitle">
  <h1>GenAI Handbook Report</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">GenAI Handbook Report</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="row g-3">

    <!-- Total Views -->
    <div class="col">
      <div class="card info-card">
        <div class="card-body">
          <h5 class="card-title">Total Views</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bx bx-show"></i>
            </div>
            <div class="ps-3"><h6>{{ number_format($views) }}</h6></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Downloads -->
    <div class="col">
      <div class="card info-card">
        <div class="card-body">
          <h5 class="card-title">Total Downloads</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bx bx-download"></i>
            </div>
            <div class="ps-3"><h6>{{ number_format($downloads) }}</h6></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Today -->
    <div class="col">
      <div class="card info-card">
        <div class="card-body">
          <h5 class="card-title">Today</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bx bx-calendar"></i>
            </div>
            <div class="ps-3">
              <div>Views: <strong>{{ $todayViews }}</strong></div>
              <div>Downloads: <strong>{{ $todayDownloads }}</strong></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chart + Filters side-by-side -->
    <div class="col-12">
      <div class="row g-3">
        <!-- Chart -->
        <div class="col-12 col-lg-8">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title d-flex justify-content-between align-items-center">
                <span>Views vs Downloads</span>
                <span id="chartLoading" class="text-muted small d-none">
                  <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                  Updating…
                </span>
              </h5>
              <div id="genaiChart"></div>
            </div>
          </div>
        </div>

        <!-- Filters (sidebar) -->
        <div class="col-12 col-lg-4">
          <div class="card h-100" style="position: sticky; top: 1rem;">
            <div class="card-body">
              <h6 class="card-title mb-3">Filters</h6>

              <!-- Quick ranges -->
              <label class="form-label mb-2">Quick range</label>
              <div class="btn-group btn-group-sm w-100 mb-3" role="group" aria-label="Ranges">
                <input type="radio" class="btn-check" name="range" id="r7">
                <label class="btn btn-outline-primary range-btn" data-range="7" for="r7">7d</label>

                <input type="radio" class="btn-check" name="range" id="r30" checked>
                <label class="btn btn-outline-primary range-btn" data-range="30" for="r30">30d</label>

                <input type="radio" class="btn-check" name="range" id="r90">
                <label class="btn btn-outline-primary range-btn" data-range="90" for="r90">90d</label>

                <input type="radio" class="btn-check" name="range" id="r365">
                <label class="btn btn-outline-primary range-btn" data-range="365" for="r365">1y</label>
              </div>

              <!-- Group by -->
              <label class="form-label mb-2">Group by</label>
              <div class="btn-group btn-group-sm w-100 mb-3" role="group" aria-label="Group by">
                <input type="radio" class="btn-check" name="groupBy" id="g-day" value="day" checked>
                <label class="btn btn-outline-secondary" for="g-day">Day</label>

                <input type="radio" class="btn-check" name="groupBy" id="g-week" value="week">
                <label class="btn btn-outline-secondary" for="g-week">Week</label>

                <input type="radio" class="btn-check" name="groupBy" id="g-month" value="month">
                <label class="btn btn-outline-secondary" for="g-month">Month</label>
              </div>

              <!-- Custom date range -->
              <label class="form-label mb-2">Custom range</label>
              <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">From</span>
                <input type="date" id="startDate" class="form-control">
              </div>
              <div class="input-group input-group-sm mb-3">
                <span class="input-group-text">To</span>
                <input type="date" id="endDate" class="form-control">
              </div>
              <div class="d-flex gap-2 mb-3">
                <button id="applyBtn" class="btn btn-secondary btn-sm w-100">Update</button>
                <button id="clearBtn" class="btn btn-outline-secondary btn-sm w-100">Clear</button>
              </div>

              <!-- Series switches -->
              <div class="border-top pt-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="showViews" checked>
                  <label class="form-check-label" for="showViews">Show Views</label>
                </div>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" id="showDownloads" checked>
                  <label class="form-check-label" for="showDownloads">Show Downloads</label>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div> <!-- /row -->
    </div> <!-- /col-12 -->

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const chartEl = document.querySelector("#genaiChart");
  const loadingEl = document.getElementById('chartLoading');

  let chart = new ApexCharts(chartEl, {
    chart: { type: 'line', height: 360 },
    series: [{ name: 'Views', data: [] }, { name: 'Downloads', data: [] }],
    xaxis: { categories: [] },
    stroke: { width: 3, curve: 'smooth' },
    markers: { size: 3 },
    dataLabels: { enabled: false },
    tooltip: { shared: true, intersect: false }
  });
  chart.render();

  // Controls
  const startDate = document.getElementById('startDate');
  const endDate   = document.getElementById('endDate');
  const applyBtn  = document.getElementById('applyBtn');
  const clearBtn  = document.getElementById('clearBtn');
  const showViews = document.getElementById('showViews');
  const showDownloads = document.getElementById('showDownloads');
  const rangeLabels = document.querySelectorAll('.range-btn');
  const groupInputs = document.querySelectorAll('input[name="groupBy"]');

  let current = { range: 30, group: 'day', start: '', end: '' };

  function groupValue() {
    const g = document.querySelector('input[name="groupBy"]:checked');
    return g ? g.value : 'day';
  }

  function setLoading(on) {
    loadingEl.classList.toggle('d-none', !on);
    applyBtn.disabled = !!on;
  }

  async function loadData() {
    setLoading(true);
    const params = new URLSearchParams();
    if (current.start && current.end) {
      params.set('start', current.start);
      params.set('end', current.end);
    } else {
      params.set('range', current.range);
    }
    params.set('group', current.group);

    const res  = await fetch(`{{ route('genai.stats') }}?` + params.toString(), { cache: 'no-store' });
    const json = await res.json();

    const series = [];
    if (showViews.checked)     series.push({ name: 'Views', data: json.views });
    if (showDownloads.checked) series.push({ name: 'Downloads', data: json.downloads });

    chart.updateOptions({ xaxis: { categories: json.labels } }, false, true);
    chart.updateSeries(series, true);
    setLoading(false);
  }

  // Quick ranges
  rangeLabels.forEach(lbl => {
    lbl.addEventListener('click', () => {
      current.range = parseInt(lbl.dataset.range, 10);
      current.start = current.end = '';
      startDate.value = '';
      endDate.value   = '';
      current.group = groupValue();
      loadData();
    });
  });

  // Grouping
  groupInputs.forEach(inp => {
    inp.addEventListener('change', () => {
      current.group = groupValue();
      loadData();
    });
  });

  // Custom range
  applyBtn.addEventListener('click', () => {
    current.start = startDate.value || '';
    current.end   = endDate.value   || '';
    loadData();
  });

  // Clear custom range → back to 30d + Day
  clearBtn.addEventListener('click', () => {
    startDate.value = '';
    endDate.value   = '';
    document.getElementById('r30').checked = true;
    document.getElementById('g-day').checked = true;
    current = { range: 30, group: 'day', start: '', end: '' };
    loadData();
  });

  // Toggle series
  showViews.addEventListener('change', loadData);
  showDownloads.addEventListener('change', loadData);

  // Initial load
  loadData();
});
</script>
@endsection
