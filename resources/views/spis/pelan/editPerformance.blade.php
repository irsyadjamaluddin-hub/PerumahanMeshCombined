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
            padding: 8px 14px;
            border-radius: 20px;
            margin: 3px;
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
        <small class="me-3">Logged in as <b>DCO</b></small>
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

        <a href="{{ route('spis.pelan.index') }}" class="btn btn-danger">
            <i class="bi bi-x"></i> Cancel
        </a>
    </div>

    

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0" style="background:#f5f9ff; border:1px solid #cfe0ff;">
        
        <!-- TOP INFO -->
        <div class="p-3 border-bottom" style="background:#eef4ff;">
            <div class="d-flex align-items-center text-primary fw-semibold">
                <i class="bi bi-bullseye me-2"></i>
                Edit KPI - Pelan Strategik
            </div>
            <small class="text-muted">
                KPI approved. You can now update Performance and Budget data.
            </small>
        </div>

        <!-- KPI INFORMATION -->
        <div class="p-4 px-5" style="
                background: #f7fbff;
                border: 1px solid #cfe0ff;
                padding: 25px 40px 20px 40px;
                margin-bottom: 20px;
            ">
                        
            <h6 class="text-primary fw-semibold mb-3">
                KPI Information
            </h6>

            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">Owner (Pemilik)</small>
                    <p>{{ $kpi->owner }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Goal / Cross Cutting Enablers</small>
                    <p>{{ $kpi->goal }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">KPI Title (Tajuk)</small>
                    <p>{{ $kpi->title }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Strategic Objectives (SO)</small>
                    <p>{{ $kpi->strategic_objective }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">KPI Blueprint/Plan Link</small>
                    <div class="form-control" style="background:#fff;">
                        @forelse(($kpi->blueprint_link ?? []) as $bp)
                            <div>{{ $bp }}</div>
                        @empty
                            <span class="text-muted">No data</span>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Key Result Areas (KRA)</small>
                    <div class="form-control" style="background:#fff;">
                        @forelse(($kpi->kra ?? []) as $kra)
                            <div>{{ $kra }}</div>
                        @empty
                            <span class="text-muted">No data</span>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body">

            <!-- KPI SECTION TITLE -->
            <div class="mb-4">
                <div style="
                    border:2px solid #d6e4ff;
                    border-radius:30px;
                    text-align:center;
                    padding:8px;
                    font-weight:600;
                    color:#4a6fdc;
                    background:#f0f5ff;
                ">
                    Performance and Budget
                </div>
            </div>

            <!-- ERROR -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

             <!-- FORM -->
            <form method="POST" action="{{ route('kpi.update', $kpi->id) }}">
                @csrf
                @method('PUT')

                <div class="accordion" id="kpiYearAccordion">

                <!-- YEAR 2022 -->
                <div class="accordion-item mb-3 border-0 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-primary"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#year2022">
                            Year 2022
                        </button>
                    </h2>

                    <div id="year2022" class="accordion-collapse collapse" data-bs-parent="#kpiYearAccordion">

                    <div class="accordion-body">

                        <label class="form-label">Baseline (2022)</label>
                        <input type="text" name="baseline_2022" class="form-control"
                            value="{{ old('baseline_2022', $kpi->baseline_2022) }}">
                    </div>
                    </div>
                </div>

                <!-- YEAR 2023 -->
                <div class="accordion-item mb-3 border-0 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-primary"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#year2023">
                            Year 2023
                        </button>
                    </h2>

                    <div id="year2023" class="accordion-collapse collapse" data-bs-parent="#kpiYearAccordion">

                    <div class="accordion-body">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Actual (2023)</label>
                            <input type="text" name="actual_2023" class="form-control"
                                value="{{ $kpi->actual_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2023)</label>
                            <input type="text" name="target_2023" class="form-control"
                                value="{{ $kpi->target_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" class="form-control"
                                value="{{ $kpi->rag_2023 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2023)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <input type="text" name="budget_type_2023" class="form-control"
                                value="{{ $kpi->budget_type_2023 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <input type="text" name="financial_year_2023" class="form-control"
                                value="{{ $kpi->financial_year_2023 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <input type="text" name="account_2023" class="form-control"
                                value="{{ $kpi->account_2023 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)</label>
                            <input type="text" name="expenditure_2023" class="form-control"
                                value="{{ $kpi->expenditure_2023 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)</label>
                            <input type="text" name="priority_2023" class="form-control"
                                value="{{ $kpi->priority_2023 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif)</label>
                            <input type="text" name="project_status_2023" class="form-control"
                                value="{{ $kpi->project_status_2023 }}">
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Information (2023)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Total Initial Budget (Jumlah Peruntukan Asal yang dipohonkan)</label>
                            <input type="number" name="initial_budget_2023" class="form-control"
                                value="{{ $kpi->initial_budget_2023 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Total Approved Budget (Jumlah Peruntukan Diluluskan)</label>
                            <input type="number" name="approved_budget_2023" class="form-control"
                                value="{{ $kpi->approved_budget_2023 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2023)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" name="po_2023" class="form-control"
                                value="{{ $kpi->po_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" name="contract_2023" class="form-control"
                                value="{{ $kpi->contract_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" name="journal_2023" class="form-control"
                                value="{{ $kpi->journal_2023 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>
                    </div>
                    </div>
                </div>

                <!-- YEAR 2024 -->
                <div class="accordion-item mb-3 border-0 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-primary"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#year2024">
                            Year 2024
                        </button>
                    </h2>

                    <div id="year2024" class="accordion-collapse collapse" data-bs-parent="#kpiYearAccordion">

                    <div class="accordion-body">

                    <div class="row g-3 mb-3">

                        <div class="col-md-4">
                            <label>Actual (2024)</label>
                            <input type="text" name="actual_2024" class="form-control"
                                value="{{ $kpi->actual_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2024)</label>
                            <input type="text" name="target_2024" class="form-control"
                                value="{{ $kpi->target_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" class="form-control"
                                value="{{ $kpi->rag_2024 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2024)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <input type="text" name="budget_type_2024" class="form-control"
                                value="{{ $kpi->budget_type_2024 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <input type="text" name="financial_year_2024" class="form-control"
                                value="{{ $kpi->financial_year_2024 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <input type="text" name="account_2024" class="form-control"
                                value="{{ $kpi->account_2024 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)</label>
                            <input type="text" name="expenditure_2024" class="form-control"
                                value="{{ $kpi->expenditure_2024 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)</label>
                            <input type="text" name="priority_2024" class="form-control"
                                value="{{ $kpi->priority_2024 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif)</label>
                            <input type="text" name="project_status_2024" class="form-control"
                                value="{{ $kpi->project_status_2024 }}">
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Information (2024)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Total Initial Budget (Jumlah Peruntukan Asal yang dipohonkan)</label>
                            <input type="number" name="initial_budget_2024" class="form-control"
                                value="{{ $kpi->initial_budget_2024 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Total Approved Budget (Jumlah Peruntukan Diluluskan)</label>
                            <input type="number" name="approved_budget_2024" class="form-control"
                                value="{{ $kpi->approved_budget_2024 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2024)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" name="po_2024" class="form-control"
                                value="{{ $kpi->po_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" name="contract_2024" class="form-control"
                                value="{{ $kpi->contract_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" name="journal_2024" class="form-control"
                                value="{{ $kpi->journal_2024 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>

                <!-- YEAR 2025 -->
                <div class="accordion-item mb-3 border-0 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-primary"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#year2025">
                            Year 2025
                        </button>
                    </h2>

                    <div id="year2025" class="accordion-collapse collapse" data-bs-parent="#kpiYearAccordion">

                    <div class="accordion-body">

                    <div class="row g-3 mb-3">

                        <div class="col-md-4">
                            <label>Actual (2025)</label>
                            <input type="text" name="actual_2025" class="form-control"
                                value="{{ $kpi->actual_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2025)</label>
                            <input type="text" name="target_2025" class="form-control"
                                value="{{ $kpi->target_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" class="form-control"
                                value="{{ $kpi->rag_2025 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2025)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <input type="text" name="budget_type_2025" class="form-control"
                                value="{{ $kpi->budget_type_2025 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <input type="text" name="financial_year_2025" class="form-control"
                                value="{{ $kpi->financial_year_2025 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <input type="text" name="account_2025" class="form-control"
                                value="{{ $kpi->account_2025 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)</label>
                            <input type="text" name="expenditure_2025" class="form-control"
                                value="{{ $kpi->expenditure_2025 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)</label>
                            <input type="text" name="priority_2025" class="form-control"
                                value="{{ $kpi->priority_2025 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif)</label>
                            <input type="text" name="project_status_2025" class="form-control"
                                value="{{ $kpi->project_status_2025 }}">
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Information (2025)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Total Initial Budget (Jumlah Peruntukan Asal yang dipohonkan)</label>
                            <input type="number" name="initial_budget_2025" class="form-control"
                                value="{{ $kpi->initial_budget_2025 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Total Approved Budget (Jumlah Peruntukan Diluluskan)</label>
                            <input type="number" name="approved_budget_2025" class="form-control"
                                value="{{ $kpi->approved_budget_2025 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2025)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" name="po_2025" class="form-control"
                                value="{{ $kpi->po_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" name="contrat_2025" class="form-control"
                                value="{{ $kpi->contract_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" name="journal_2025" class="form-control"
                                value="{{ $kpi->journal_2025 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>

                <!-- YEAR 2026 -->
                <div class="accordion-item mb-3 border-0 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-primary"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#year2026">
                            Year 2026
                        </button>
                    </h2>

                    <div id="year2026" class="accordion-collapse collapse" data-bs-parent="#kpiYearAccordion">

                    <div class="accordion-body">

                    <div class="row g-3 mb-3">

                        <div class="col-md-4">
                            <label>Actual (2026)</label>
                            <input type="text" name="actual_2026" class="form-control"
                                value="{{ $kpi->actual_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2026)</label>
                            <input type="text" name="target_2026" class="form-control"
                                value="{{ $kpi->target_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" class="form-control"
                                value="{{ $kpi->rag_2026 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2026)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <input type="text" name="budget_type_2026" class="form-control"
                                value="{{ $kpi->budget_type_2026 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <input type="text" name="financial_year_2026" class="form-control"
                                value="{{ $kpi->financial_year_2026 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <input type="text" name="account_2026" class="form-control"
                                value="{{ $kpi->account_2026 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)</label>
                            <input type="text" name="expenditure_2026" class="form-control"
                                value="{{ $kpi->expenditure_2026 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)</label>
                            <input type="text" name="priority_2026" class="form-control"
                                value="{{ $kpi->priority_2026 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif)</label>
                            <input type="text" name="project_status_2026" class="form-control"
                                value="{{ $kpi->project_status_2026 }}">
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Information (2026)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Total Initial Budget (Jumlah Peruntukan Asal yang dipohonkan)</label>
                            <input type="number" name="initial_budget_2026" class="form-control"
                                value="{{ $kpi->initial_budget_2026 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Total Approved Budget (Jumlah Peruntukan Diluluskan)</label>
                            <input type="number" name="approved_budget_2026" class="form-control"
                                value="{{ $kpi->approved_budget_2026 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2026)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" name="po_2026" class="form-control"
                                value="{{ $kpi->po_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" name="contrast_2026" class="form-control"
                                value="{{ $kpi->contrast_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" name="journal_2026" class="form-control"
                                value="{{ $kpi->journal_2026 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>

                <!-- YEAR 2027 -->
                <div class="accordion-item mb-3 border-0 shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold text-primary"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#year2027">
                            Year 2027
                        </button>
                    </h2>

                    <div id="year2027" class="accordion-collapse collapse" data-bs-parent="#kpiYearAccordion">

                    <div class="accordion-body">

                    <div class="row g-3 mb-3">

                        <div class="col-md-4">
                            <label>Actual (2027)</label>
                            <input type="text" name="actual_2027" class="form-control"
                                value="{{ $kpi->actual_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2027)</label>
                            <input type="text" name="target_2027" class="form-control"
                                value="{{ $kpi->target_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" class="form-control"
                                value="{{ $kpi->rag_2027 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2027)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <input type="text" name="budget_type_2027" class="form-control"
                                value="{{ $kpi->budget_type_2027 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <input type="text" name="financial_year_2027" class="form-control"
                                value="{{ $kpi->financial_year_2027 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <input type="text" name="account_2027" class="form-control"
                                value="{{ $kpi->account_2027 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)</label>
                            <input type="text" name="expenditure_2027" class="form-control"
                                value="{{ $kpi->expenditure_2027 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)</label>
                            <input type="text" name="priority_2027" class="form-control"
                                value="{{ $kpi->priority_2027 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif)</label>
                            <input type="text" name="project_status_2027" class="form-control"
                                value="{{ $kpi->project_status_2027 }}">
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Information (2027)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Total Initial Budget (Jumlah Peruntukan Asal yang dipohonkan)</label>
                            <input type="number" name="initial_budget_2027" class="form-control"
                                value="{{ $kpi->initial_budget_2027 }}">
                        </div>

                        <div class="col-md-6">
                            <label>Total Approved Budget (Jumlah Peruntukan Diluluskan)</label>
                            <input type="number" name="approved_budget_2027" class="form-control"
                                value="{{ $kpi->approved_budget_2027 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2027)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" name="po_2027" class="form-control"
                                value="{{ $kpi->po_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" name="contrast_2027" class="form-control"
                                value="{{ $kpi->contrast_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" name="journal_2027" class="form-control"
                                value="{{ $kpi->journal_2027 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" name="initial_budget_2022" class="form-control"
                                value="{{ $kpi->initial_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" name="approved_budget_2022" class="form-control"
                                value="{{ $kpi->approved_budget_2022 ?? 'Not yet started' }}" readonly>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>

                <!-- BUTTON -->
                <div class="mt-4 text-end">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i> Update KPI
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    Strategic Performance Information System © 2026 | Powered By DevOps
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>