<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPIS Pelan Strategik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }

        body {
            background-color: #eef3f9;
            margin: 0;
        }

        /* TOP HEADER */
        .topbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #2f5bd3, #4a7be6);
            color: white;
            padding: 15px 25px;
        }

        .topbar h4 {
            margin: 0;
            font-weight: 600;
        }

        .topbar small {
            opacity: 0.9;
        }

        /* MENU BAR */
        .menubar {
            background: #f1f3f6;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }

        .menu-item {
            margin-right: 15px;
            padding: 8px 14px;
            border-radius: 8px;
            color: #333;
            text-decoration: none;
        }

        .menu-item.active {
            background: #2f5bd3;
            color: white;
        }

        .menu-item:hover {
            background: #dfe7ff;
        }

        /* CARDS */
        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        /* WELCOME BOX */
        .welcome-box {
            background: #f5f9ff;
            border: 1px solid #cfe0ff;
        }

        /* EMPTY KPI BOX */
        .empty-box {
            border: 2px dashed #cfd8e3;
            border-radius: 15px;
        }

        .badge-custom {
            background: #e9eef5;
            color: #333;
            padding: 6px 12px;
            border-radius: 20px;
            margin: 3px 3px 3px 0;
            display: inline-block;

            /* FIX TEXT CUT-OFF */
            white-space: normal;
            word-break: break-word;
            max-width: 100%;
        }

        /* TABLE HEADER */
        .kpi-table {
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
        }

        .kpi-table thead th:first-child {
            border-top-left-radius: 12px;
        }

        .kpi-table thead th:last-child {
            border-top-right-radius: 12px;
        }

        .kpi-table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        .kpi-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        .kpi-table thead tr {
            background: linear-gradient(90deg, #2f5bd3, #4a7be6);
        }

        .kpi-table thead th {
            background: transparent !important;
            color: white;
            border: none;
            padding: 14px 12px; /* top & bottom spacing */
            font-weight: 500;
        }

        /* ROW STYLE */
        .kpi-table tbody tr {
            background: #f9fbff;
            border-bottom: 1px solid #e3e8f0;
        }

        /* PROGRESS BAR */
        .progress-sm {
            height: 6px;
            background: #e9eef5;
            border-radius: 10px;
        }

        .progress-bar {
            background: #2f5bd3;
        }

        /* STATUS BADGES */
        .status-draft {
            background: #eef1f5;
            color: #333;
            border-radius: 20px;
            padding: 5px 12px;
        }

        .status-submitted {
            background: #fff3cd;
            color: #856404;
            border-radius: 20px;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
            border-radius: 20px;
        }

        .status-rejected {
            background: #f8d7da;
            color: #842029;
            border-radius: 20px;
        }

        /* RAG */
        .rag-badge {
            background: #eef1f5;
            border-radius: 50%;
            padding: 6px 10px;
        }

        /* FOOTER */
        .footer {
            background: linear-gradient(90deg, #2f5bd3, #4a7be6);
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- TOP HEADER -->
<div class="topbar d-flex justify-content-between align-items-center">
    <div>
        <h4>
            <i class="bi bi-bar-chart"></i>
            Strategic Performance Information System
        </h4>
        <small>Monitor and manage your key performance metrics</small>
    </div>

    <div>
        <small class="me-3">Logged in as <b>Sepadu</b></small>
        <button class="btn btn-light btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </div>
</div>

<!-- MENU BAR -->
<div class="menubar d-flex align-items-center">
    <a href="{{ route('spis.index') }}" class="menu-item"><i class="bi bi-bar-chart"></i> Dashboard</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item active"><i class="bi bi-folder"></i> Pelan Strategik</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Green Education Plan</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Digital Transformation Plan</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Manpower Blueprint</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Wawasan Brunei 2035-Matlamat 1</a>
</div>

<!-- HEADER SECTION -->
<div class="container-fluid px-4 py-4 flex-fill">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold text-primary mb-1">Pelan Strategik</h3>
            <small class="text-muted">Strategic planning KPIs</small>
        </div>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- EMPTY STATE -->
    @if($kpis->isEmpty())
    <div class="card shadow-sm empty-box">
        <div class="card-body py-4">

            <p class="mb-1 fw-semibold text-dark">
                No KPIs in this folder
            </p>

            <small class="text-primary">
                No KPIs available for review at this time
            </small>

        </div>
    </div>
    @endif

    @php
        $hasSubmitted = $kpis->whereIn('status', ['submitted', 'approved', 'rejected'])->count() > 0;
    @endphp

    @if($hasSubmitted)
    <!-- KPI LIST -->
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table align-middle mb-0 kpi-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>KPI Title</th>
                        <th>Owner</th>
                        <th>Baseline (2022)</th>
                        <th>Target (2027)</th>
                        <th>Status RAG</th>
                        <th>Progress</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated By</th>
                        <th>Workflow Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($kpis as $kpi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="fw-semibold">{{ $kpi->title }}</td>

                        <td>{{ $kpi->owner }}</td>

                        <td>-</td>
                        <td>-</td>

                        <!-- RAG -->
                        <td>
                            <span class="badge rag-badge">-</span>
                        </td>

                        <!-- PROGRESS -->
                        <td style="width:120px;">
                            <div class="progress progress-sm">
                                <div class="progress-bar" style="width: {{ $kpi->progress ?? 0 }}%"></div>
                            </div>
                            <small>{{ $kpi->progress ?? 0 }}%</small>
                        </td>

                        <td>{{ $kpi->created_by ?? 'dco' }}</td>
                        <td>{{ $kpi->created_at->format('d/m/Y, h:i A') }}</td>
                        <td>-</td>

                        <!-- WORKFLOW -->
                        <td>
                            @if($kpi->status == 'draft')
                                <span class="badge status-draft">Draft</span>
                            @elseif($kpi->status == 'submitted')
                                <span class="badge status-submitted">Submitted</span>
                            @elseif($kpi->status == 'approved')
                                <span class="badge status-approved">Approved</span>
                            @elseif($kpi->status == 'rejected')
                                <span class="badge status-rejected">Rejected</span>
                            @endif
                        </td>

                        <!-- ACTIONS -->
                        <td class="d-flex gap-2">
                            <button class="btn btn-light btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $kpi->id }}">
                                <i class="bi bi-eye"></i> View
                            </button>

                            <form method="POST"
                                action="{{ route('kpi.destroy', $kpi->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- MODAL -->
             @foreach($kpis as $kpi)
                    <div class="modal fade" id="viewModal{{ $kpi->id }}">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content rounded-4">

                                <!-- HEADER -->
                                <div class="modal-header border-0">
                                    <h5 class="fw-bold text-primary">
                                        <i class="bi bi-bullseye"></i> KPI Details
                                    </h5>

                                </div>

                                <!-- BODY -->
                                <div class="modal-body">

                                    <!-- KPI IDENTIFICATION -->
                                    <div class="card p-3 mb-3 border-0 shadow-sm">
                                        <h6 class="text-primary fw-semibold mb-3">
                                            KPI Identification
                                        </h6>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">Owner (Pemilik)</small>
                                                <p>{{ $kpi->owner }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <small class="text-muted">Goal/Cross Cutting Enablers</small>
                                                <p>{{ $kpi->goal ?? '-' }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <small class="text-muted">KPI Title (Tajuk)</small>
                                                <p>{{ $kpi->title }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <small class="text-muted">Strategic Objectives (SO)</small>
                                                <p>{{ $kpi->strategic_objective ?? '-' }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <small class="text-muted">KPI Blueprint/Plan Link</small>
                                                <div>
                                                    @php
                                                        $blueprints = is_array($kpi->blueprint_link)
                                                            ? $kpi->blueprint_link
                                                            : (is_string($kpi->blueprint_link) ? json_decode($kpi->blueprint_link, true) : []);
                                                    @endphp

                                                    @if(!empty($blueprints))
                                                        @foreach($blueprints as $item)
                                                            <span class="badge-custom">
                                                                {{ $item }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <small class="text-muted">Key Result Areas (KRA)</small>
                                                <div>
                                                    @php
                                                        $kras = is_array($kpi->kra)
                                                            ? $kpi->kra
                                                            : (is_string($kpi->kra) ? json_decode($kpi->kra, true) : []);
                                                    @endphp

                                                    @if(!empty($kras))
                                                        @foreach($kras as $item)
                                                            <span class="badge-custom">
                                                                {{ $item }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- WORKFLOW -->
                                    @php
                                        $status = $kpi->status ?? 'draft';
                                    @endphp

                                    <div class="card p-3 border-0 shadow-sm">
                                        <h6 class="text-primary fw-semibold mb-3">
                                            Workflow Status
                                        </h6>

                                        <ul class="list-unstyled">

                                            {{-- DCO SUBMISSION --}}
                                            <li class="mb-2">
                                                @if(in_array($status, ['submitted', 'approved', 'rejected']))
                                                    <i class="bi bi-check-circle-fill text-success"></i>
                                                @else
                                                    <i class="bi bi-circle text-muted"></i>
                                                @endif

                                                <span class="ms-1">DCO Submission</span>

                                                @if($status == 'submitted')
                                                    <span class="badge bg-info ms-2">Submitted</span>
                                                @endif
                                            </li>

                                            {{-- SEPADU APPROVAL --}}
                                            <li class="mb-2">

                                                @if($status == 'approved')
                                                    <i class="bi bi-check-circle-fill text-success"></i>
                                                    <span class="ms-1">Sepadu Approval</span>
                                                    <span class="badge bg-success ms-2">Approved</span>

                                                @elseif($status == 'rejected')
                                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                                    <span class="ms-1">Sepadu Approval</span>
                                                    <span class="badge bg-danger ms-2">Rejected</span>

                                                @else
                                                    <i class="bi bi-circle text-muted"></i>
                                                    <span class="ms-1">Sepadu Approval</span>
                                                @endif

                                            </li>

                                        </ul>

                                        {{-- ACTION BUTTONS (ONLY WHEN SUBMITTED) --}}
                                        @if($status == 'submitted')
                                            <div class="d-flex gap-2 mt-3">

                                                <!-- APPROVE -->
                                                <form method="POST"
                                                    action="{{ route('kpi.approve', $kpi->id) }}"
                                                    class="flex-fill">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm w-100 d-flex align-items-center justify-content-center gap-2 fs-6">
                                                        <i class="bi bi-check-circle"></i>
                                                        Approve
                                                    </button>
                                                </form>

                                                <!-- REJECT -->
                                                <form method="POST"
                                                    action="{{ route('kpi.reject', $kpi->id) }}"
                                                    class="flex-fill">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2 fs-6">
                                                        <i class="bi bi-x-circle"></i>
                                                        Reject
                                                    </button>
                                                </form>

                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- FOOTER -->
                                <div class="modal-footer border-0">
                                    <button class="btn btn-light"
                                            data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
    @endif
</div>

<!-- FOOTER -->
<div class="footer">
    Strategic Performance Information System © 2026 | Powered By DevOps
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>