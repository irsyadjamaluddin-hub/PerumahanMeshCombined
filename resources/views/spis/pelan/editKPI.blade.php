<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPIS Pelan Strategik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

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
                            <input type="text" id="actual_2023" name="actual_2023" class="form-control"
                                value="{{ $kpi->actual_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2023)</label>
                            <input type="text" id="target_2023" name="target_2023" class="form-control"
                                value="{{ $kpi->target_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" id="rag_2023" name="rag_2023" class="form-control"
                                value="{{ $kpi->rag_2023 }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2023)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <select name="budget_type_2023" class="form-select">
                                <option value="">Select Budget Type</option>
                                <option value="OCAR"
                                    {{ $kpi->budget_type_2023 == 'OCAR' ? 'selected' : '' }}>
                                    OCAR (Other Charges Annual Recurrent)
                                </option>
                                <option value="RKN"
                                    {{ $kpi->budget_type_2023 == 'RKN' ? 'selected' : '' }}>
                                    RKN (Rancangan Kemajuan Negara)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <select name="financial_year_2023" class="form-select select2">
                                <option value="">Select Financial Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}"
                                        {{ $kpi->financial_year_2023 == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <select name="account_2023" class="form-select">
                                <option value="">Select Account</option>
                                <option value="2108"
                                    {{ $kpi->account_2023 == '2108' ? 'selected' : '' }}>
                                    2108 - Teknologi Maklumat dan Info-Komunikasi
                                </option>
                                <option value="2109"
                                    {{ $kpi->account_2023 == '2109' ? 'selected' : '' }}>
                                    2109 - Perkhidmatan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Baseline</strong> - Peruntukan sebenar operasi untuk menjalankan core business Kementerian dan Jabatan masing-masing.<br><br>
                            Ini termasuk pemeliharaan aset Kerajaan bagi mengelakkan kerosakan dan kerugian.<br><br>
                            <strong>One-off</strong> – One-off Project.
                            ">
                            </i></label>
                            <select name="expenditure_2023" class="form-select">
                                <option value="">Select Type</option>
                                <option value="Baseline"
                                    {{ $kpi->expenditure_2023 == 'Baseline' ? 'selected' : '' }}>
                                    Baseline
                                </option>
                                <option value="One-Off"
                                    {{ $kpi->expenditure_2023 == 'One-Off' ? 'selected' : '' }}>
                                    One-Off
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>K1</strong> - Perbelanjaan tahunan berkeutamaan tinggi (kontrak berjalan / projek one-off berjalan).<br><br>
                            <strong>K2</strong> - Perbelanjaan tidak berkontrak atau pembaharuan kontrak yang boleh dikemaskini.<br><br>
                            <strong>K3</strong> - Perbelanjaan baru atau cadangan (one-off / planning stage).
                            ">
                            </i></label>
                            <select name="priority_2023" class="form-select">
                                <option value="">Select Priority</option>
                                <option value="K1"
                                    {{ $kpi->priority_2023 == 'K1' ? 'selected' : '' }}>
                                    K1 (Priority / Keutamaan 1)
                                </option>
                                <option value="K2"
                                    {{ $kpi->priority_2023 == 'K2' ? 'selected' : '' }}>
                                    K2 (Priority / Keutamaan 2)
                                </option>
                                <option value="K3"
                                    {{ $kpi->priority_2023 == 'K3' ? 'selected' : '' }}>
                                    K3 (Priority / Keutamaan 3)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Dalam perancangan (Baru)</strong> - Proposal, Evaluation, Planning Stage, Technical Completion.<br><br>
                            <strong>Proses tawaran</strong> - Procurement / Tender Stage.<br><br>
                            <strong>Dalam pelaksanaan</strong> - Additional Budget Request, Design Stage, Implementation Stage.
                            ">
                            </i></label>
                            <select name="project_status_2023" class="form-select">
                                <option value="">Select Status</option>

                                <option value="Dalam Perancangan (Baru)"
                                    {{ $kpi->project_status_2023 == 'Dalam Perancangan (Baru)' ? 'selected' : '' }}>
                                    Dalam Perancangan (Baru)
                                </option>

                                <option value="Proses Tawaran"
                                    {{ $kpi->project_status_2023 == 'Proses Tawaran' ? 'selected' : '' }}>
                                    Proses Tawaran
                                </option>

                                <option value="Dalam Pelaksanaan"
                                    {{ $kpi->project_status_2023 == 'Dalam Pelaksanaan' ? 'selected' : '' }}>
                                    Dalam Pelaksanaan
                                </option>

                                <option value="Selesai"
                                    {{ $kpi->project_status_2023 == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>
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
                            <input type="number" id="approved_budget_2023" name="approved_budget_2023" class="form-control"
                                value="{{ $kpi->approved_budget_2023 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2023)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" id="po_2023" name="po_2023" class="form-control"
                                value="{{ $kpi->po_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" id="contract_2023" name="contract_2023" class="form-control"
                                value="{{ $kpi->contract_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" id="journal_2023" name="journal_2023" class="form-control"
                                value="{{ $kpi->journal_2023 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_expenditure_2023" name="total_expenditure_2023" class="form-control"
                                value="{{ $kpi->total_expenditure_2023 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_percentage_2023" name="total_percentage_2023" class="form-control"
                                value="{{ $kpi->total_percentage_2023 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_expenditure_2022" class="form-control"
                                value="{{ $kpi->date_expenditure_2022 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_balance_2023" name="total_balance_2023" class="form-control"
                                value="{{ $kpi->total_balance_2023 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_balance_percentage_2023" name="total_balance_percentage_2023" class="form-control"
                                value="{{ $kpi->total_balance_percentage_2023 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_balance_2023" class="form-control"
                                value="{{ $kpi->date_balance_2023 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q1_2023" name="target_q1_2023" class="form-control"
                                value="{{ $kpi->target_q1_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q1_2023" name="actual_q1_2023" class="form-control"
                                value="{{ $kpi->actual_q1_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q1_2023" name="rag_q1_2023" class="form-control"
                                value="{{ $kpi->rag_q1_2023 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q2_2023" name="target_q2_2023" class="form-control"
                                value="{{ $kpi->target_q2_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q2_2023" name="actual_q2_2023" class="form-control"
                                value="{{ $kpi->actual_q2_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q2_2023" name="rag_q1_2023" class="form-control"
                                value="{{ $kpi->rag_q2_2023 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q3_2023" name="target_q3_2023" class="form-control"
                                value="{{ $kpi->target_q3_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q3_2023" name="actual_q3_2023" class="form-control"
                                value="{{ $kpi->actual_q3_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q3_2023" name="rag_q3_2023" class="form-control"
                                value="{{ $kpi->rag_q3_2023 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q4_2023" name="target_q4_2023" class="form-control"
                                value="{{ $kpi->target_q4_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q4_2023" name="actual_q3_2023"  class="form-control"
                                value="{{ $kpi->actual_q4_2023 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q4_2023" name="rag_q4_2023" class="form-control"
                                value="{{ $kpi->rag_q4_2023 ?? 'Not yet started' }}" readonly>
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
                            <input type="text" id="actual_2024" name="actual_2024" class="form-control"
                                value="{{ $kpi->actual_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2024)</label>
                            <input type="text" id="target_2024" name="target_2024" class="form-control"
                                value="{{ $kpi->target_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" id="rag_2024" name="rag_2024" class="form-control"
                                value="{{ $kpi->rag_2024 }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2024)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <select name="budget_type_2024" class="form-select">
                                <option value="">Select Budget Type</option>
                                <option value="OCAR"
                                    {{ $kpi->budget_type_2024 == 'OCAR' ? 'selected' : '' }}>
                                    OCAR (Other Charges Annual Recurrent)
                                </option>
                                <option value="RKN"
                                    {{ $kpi->budget_type_2024 == 'RKN' ? 'selected' : '' }}>
                                    RKN (Rancangan Kemajuan Negara)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <select name="financial_year_2024" class="form-select select2">
                                <option value="">Select Financial Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}"
                                        {{ $kpi->financial_year_2024 == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <select name="account_2024" class="form-select">
                                <option value="">Select Account</option>
                                <option value="2108"
                                    {{ $kpi->account_2024 == '2108' ? 'selected' : '' }}>
                                    2108 - Teknologi Maklumat dan Info-Komunikasi
                                </option>
                                <option value="2109"
                                    {{ $kpi->account_2024 == '2109' ? 'selected' : '' }}>
                                    2109 - Perkhidmatan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Baseline</strong> - Peruntukan sebenar operasi untuk menjalankan core business Kementerian dan Jabatan masing-masing.<br><br>
                            Ini termasuk pemeliharaan aset Kerajaan bagi mengelakkan kerosakan dan kerugian.<br><br>
                            <strong>One-off</strong> – One-off Project.
                            ">
                            </i></label>
                            <select name="expenditure_2024" class="form-select">
                                <option value="">Select Type</option>
                                <option value="Baseline"
                                    {{ $kpi->expenditure_2024 == 'Baseline' ? 'selected' : '' }}>
                                    Baseline
                                </option>
                                <option value="One-Off"
                                    {{ $kpi->expenditure_2024 == 'One-Off' ? 'selected' : '' }}>
                                    One-Off
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>K1</strong> - Perbelanjaan tahunan berkeutamaan tinggi (kontrak berjalan / projek one-off berjalan).<br><br>
                            <strong>K2</strong> - Perbelanjaan tidak berkontrak atau pembaharuan kontrak yang boleh dikemaskini.<br><br>
                            <strong>K3</strong> - Perbelanjaan baru atau cadangan (one-off / planning stage).
                            ">
                            </i></label>
                            <select name="priority_2024" class="form-select">
                                <option value="">Select Priority</option>
                                <option value="K1"
                                    {{ $kpi->priority_2024 == 'K1' ? 'selected' : '' }}>
                                    K1 (Priority / Keutamaan 1)
                                </option>
                                <option value="K2"
                                    {{ $kpi->priority_2024 == 'K2' ? 'selected' : '' }}>
                                    K2 (Priority / Keutamaan 2)
                                </option>
                                <option value="K3"
                                    {{ $kpi->priority_2024 == 'K3' ? 'selected' : '' }}>
                                    K3 (Priority / Keutamaan 3)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif) <i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Dalam perancangan (Baru)</strong> - Proposal, Evaluation, Planning Stage, Technical Completion.<br><br>
                            <strong>Proses tawaran</strong> - Procurement / Tender Stage.<br><br>
                            <strong>Dalam pelaksanaan</strong> - Additional Budget Request, Design Stage, Implementation Stage.
                            ">
                            </i></label>
                            <select name="project_status_2024" class="form-select">
                                <option value="">Select Status</option>

                                <option value="Dalam Perancangan (Baru)"
                                    {{ $kpi->project_status_2024 == 'Dalam Perancangan (Baru)' ? 'selected' : '' }}>
                                    Dalam Perancangan (Baru)
                                </option>

                                <option value="Proses Tawaran"
                                    {{ $kpi->project_status_2024 == 'Proses Tawaran' ? 'selected' : '' }}>
                                    Proses Tawaran
                                </option>

                                <option value="Dalam Pelaksanaan"
                                    {{ $kpi->project_status_2024 == 'Dalam Pelaksanaan' ? 'selected' : '' }}>
                                    Dalam Pelaksanaan
                                </option>

                                <option value="Selesai"
                                    {{ $kpi->project_status_2024 == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>
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
                            <input type="number" id="approved_budget_2024" name="approved_budget_2024" class="form-control"
                                value="{{ $kpi->approved_budget_2024 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2024)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" id="po_2024" name="po_2024" class="form-control"
                                value="{{ $kpi->po_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" id="contract_2024" name="contract_2024" class="form-control"
                                value="{{ $kpi->contract_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" id="journal_2024" name="journal_2024" class="form-control"
                                value="{{ $kpi->journal_2024 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_expenditure_2024" name="total_expenditure_2024" class="form-control"
                                value="{{ $kpi->total_expenditure_2024 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_percentage_2024" name="total_percentage_2024" class="form-control"
                                value="{{ $kpi->total_percentage_2024 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_expenditure_2024" class="form-control"
                                value="{{ $kpi->date_expenditure_2024 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_balance_2024" name="total_balance_2024" class="form-control"
                                value="{{ $kpi->total_balance_2024 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_balance_percentage_2024" name="total_balance_percentage_2024" class="form-control"
                                value="{{ $kpi->total_balance_percentage_2024 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_balance_2024" class="form-control"
                                value="{{ $kpi->date_balance_2024 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q1_2024" name="target_q1_2024" class="form-control"
                                value="{{ $kpi->target_q1_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q1_2024" name="actual_q1_2024" class="form-control"
                                value="{{ $kpi->actual_q1_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q1_2024" name="rag_q1_2024" class="form-control"
                                value="{{ $kpi->rag_q1_2024 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q2_2024" name="target_q2_2024" class="form-control"
                                value="{{ $kpi->target_q2_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q2_2024" name="actual_q2_2024" class="form-control"
                                value="{{ $kpi->actual_q2_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q2_2024" name="rag_q1_2024" class="form-control"
                                value="{{ $kpi->rag_q2_2024 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q3_2024" name="target_q3_2024" class="form-control"
                                value="{{ $kpi->target_q3_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q3_2024" name="actual_q3_2024" class="form-control"
                                value="{{ $kpi->actual_q3_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q3_2024" name="rag_q3_2024" class="form-control"
                                value="{{ $kpi->rag_q3_2024 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q4_2024" name="target_q4_2024" class="form-control"
                                value="{{ $kpi->target_q4_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q4_2024" name="actual_q3_2024"  class="form-control"
                                value="{{ $kpi->actual_q4_2024 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q4_2024" name="rag_q4_2024" class="form-control"
                                value="{{ $kpi->rag_q4_2024 ?? 'Not yet started' }}" readonly>
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
                            <input type="text" id="actual_2025" name="actual_2025" class="form-control"
                                value="{{ $kpi->actual_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2025)</label>
                            <input type="text" id="target_2025" name="target_2025" class="form-control"
                                value="{{ $kpi->target_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" id="rag_2025" name="rag_2025" class="form-control"
                                value="{{ $kpi->rag_2025 }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2025)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <select name="budget_type_2025" class="form-select">
                                <option value="">Select Budget Type</option>
                                <option value="OCAR"
                                    {{ $kpi->budget_type_2025 == 'OCAR' ? 'selected' : '' }}>
                                    OCAR (Other Charges Annual Recurrent)
                                </option>
                                <option value="RKN"
                                    {{ $kpi->budget_type_2025 == 'RKN' ? 'selected' : '' }}>
                                    RKN (Rancangan Kemajuan Negara)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <select name="financial_year_2025" class="form-select select2">
                                <option value="">Select Financial Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}"
                                        {{ $kpi->financial_year_2025 == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <select name="account_2025" class="form-select">
                                <option value="">Select Account</option>
                                <option value="2108"
                                    {{ $kpi->account_2025 == '2108' ? 'selected' : '' }}>
                                    2108 - Teknologi Maklumat dan Info-Komunikasi
                                </option>
                                <option value="2109"
                                    {{ $kpi->account_2025 == '2109' ? 'selected' : '' }}>
                                    2109 - Perkhidmatan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Baseline</strong> - Peruntukan sebenar operasi untuk menjalankan core business Kementerian dan Jabatan masing-masing.<br><br>
                            Ini termasuk pemeliharaan aset Kerajaan bagi mengelakkan kerosakan dan kerugian.<br><br>
                            <strong>One-off</strong> – One-off Project.
                            ">
                            </i></label>
                            <select name="expenditure_2025" class="form-select">
                                <option value="">Select Type</option>
                                <option value="Baseline"
                                    {{ $kpi->expenditure_2025 == 'Baseline' ? 'selected' : '' }}>
                                    Baseline
                                </option>
                                <option value="One-Off"
                                    {{ $kpi->expenditure_2025 == 'One-Off' ? 'selected' : '' }}>
                                    One-Off
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>K1</strong> - Perbelanjaan tahunan berkeutamaan tinggi (kontrak berjalan / projek one-off berjalan).<br><br>
                            <strong>K2</strong> - Perbelanjaan tidak berkontrak atau pembaharuan kontrak yang boleh dikemaskini.<br><br>
                            <strong>K3</strong> - Perbelanjaan baru atau cadangan (one-off / planning stage).
                            ">
                            </i></label>
                            <select name="priority_2025" class="form-select">
                                <option value="">Select Priority</option>
                                <option value="K1"
                                    {{ $kpi->priority_2025 == 'K1' ? 'selected' : '' }}>
                                    K1 (Priority / Keutamaan 1)
                                </option>
                                <option value="K2"
                                    {{ $kpi->priority_2025 == 'K2' ? 'selected' : '' }}>
                                    K2 (Priority / Keutamaan 2)
                                </option>
                                <option value="K3"
                                    {{ $kpi->priority_2025 == 'K3' ? 'selected' : '' }}>
                                    K3 (Priority / Keutamaan 3)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif) <i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Dalam perancangan (Baru)</strong> - Proposal, Evaluation, Planning Stage, Technical Completion.<br><br>
                            <strong>Proses tawaran</strong> - Procurement / Tender Stage.<br><br>
                            <strong>Dalam pelaksanaan</strong> - Additional Budget Request, Design Stage, Implementation Stage.
                            ">
                            </i></label>
                            <select name="project_status_2025" class="form-select">
                                <option value="">Select Status</option>

                                <option value="Dalam Perancangan (Baru)"
                                    {{ $kpi->project_status_2025 == 'Dalam Perancangan (Baru)' ? 'selected' : '' }}>
                                    Dalam Perancangan (Baru)
                                </option>

                                <option value="Proses Tawaran"
                                    {{ $kpi->project_status_2025 == 'Proses Tawaran' ? 'selected' : '' }}>
                                    Proses Tawaran
                                </option>

                                <option value="Dalam Pelaksanaan"
                                    {{ $kpi->project_status_2025 == 'Dalam Pelaksanaan' ? 'selected' : '' }}>
                                    Dalam Pelaksanaan
                                </option>

                                <option value="Selesai"
                                    {{ $kpi->project_status_2025 == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>
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
                            <input type="number" id="approved_budget_2025" name="approved_budget_2025" class="form-control"
                                value="{{ $kpi->approved_budget_2025 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2025)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" id="po_2025" name="po_2025" class="form-control"
                                value="{{ $kpi->po_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" id="contract_2025" name="contract_2025" class="form-control"
                                value="{{ $kpi->contract_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" id="journal_2025" name="journal_2025" class="form-control"
                                value="{{ $kpi->journal_2025 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_expenditure_2025" name="total_expenditure_2025" class="form-control"
                                value="{{ $kpi->total_expenditure_2025 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_percentage_2025" name="total_percentage_2025" class="form-control"
                                value="{{ $kpi->total_percentage_2025 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_expenditure_2025" class="form-control"
                                value="{{ $kpi->date_expenditure_2025 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_balance_2025" name="total_balance_2025" class="form-control"
                                value="{{ $kpi->total_balance_2025 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_balance_percentage_2025" name="total_balance_percentage_2025" class="form-control"
                                value="{{ $kpi->total_balance_percentage_2025 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_balance_2025" class="form-control"
                                value="{{ $kpi->date_balance_2025 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q1_2025" name="target_q1_2025" class="form-control"
                                value="{{ $kpi->target_q1_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q1_2025" name="actual_q1_2025" class="form-control"
                                value="{{ $kpi->actual_q1_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q1_2025" name="rag_q1_2025" class="form-control"
                                value="{{ $kpi->rag_q1_2025 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q2_2025" name="target_q2_2025" class="form-control"
                                value="{{ $kpi->target_q2_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q2_2025" name="actual_q2_2025" class="form-control"
                                value="{{ $kpi->actual_q2_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q2_2025" name="rag_q1_2025" class="form-control"
                                value="{{ $kpi->rag_q2_2025 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q3_2025" name="target_q3_2025" class="form-control"
                                value="{{ $kpi->target_q3_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q3_2025" name="actual_q3_2025" class="form-control"
                                value="{{ $kpi->actual_q3_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q3_2025" name="rag_q3_2025" class="form-control"
                                value="{{ $kpi->rag_q3_2025 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q4_2025" name="target_q4_2025" class="form-control"
                                value="{{ $kpi->target_q4_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q4_2025" name="actual_q3_2025"  class="form-control"
                                value="{{ $kpi->actual_q4_2025 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q4_2025" name="rag_q4_2025" class="form-control"
                                value="{{ $kpi->rag_q4_2025 ?? 'Not yet started' }}" readonly>
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
                            <input type="text" id="actual_2026" name="actual_2026" class="form-control"
                                value="{{ $kpi->actual_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2026)</label>
                            <input type="text" id="target_2026" name="target_2026" class="form-control"
                                value="{{ $kpi->target_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" id="rag_2026" name="rag_2026" class="form-control"
                                value="{{ $kpi->rag_2026 }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2026)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <select name="budget_type_2026" class="form-select">
                                <option value="">Select Budget Type</option>
                                <option value="OCAR"
                                    {{ $kpi->budget_type_2026 == 'OCAR' ? 'selected' : '' }}>
                                    OCAR (Other Charges Annual Recurrent)
                                </option>
                                <option value="RKN"
                                    {{ $kpi->budget_type_2026 == 'RKN' ? 'selected' : '' }}>
                                    RKN (Rancangan Kemajuan Negara)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <select name="financial_year_2026" class="form-select select2">
                                <option value="">Select Financial Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}"
                                        {{ $kpi->financial_year_2026 == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <select name="account_2026" class="form-select">
                                <option value="">Select Account</option>
                                <option value="2108"
                                    {{ $kpi->account_2026 == '2108' ? 'selected' : '' }}>
                                    2108 - Teknologi Maklumat dan Info-Komunikasi
                                </option>
                                <option value="2109"
                                    {{ $kpi->account_2026 == '2109' ? 'selected' : '' }}>
                                    2109 - Perkhidmatan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Baseline</strong> - Peruntukan sebenar operasi untuk menjalankan core business Kementerian dan Jabatan masing-masing.<br><br>
                            Ini termasuk pemeliharaan aset Kerajaan bagi mengelakkan kerosakan dan kerugian.<br><br>
                            <strong>One-off</strong> – One-off Project.
                            ">
                            </i></label>
                            <select name="expenditure_2026" class="form-select">
                                <option value="">Select Type</option>
                                <option value="Baseline"
                                    {{ $kpi->expenditure_2026 == 'Baseline' ? 'selected' : '' }}>
                                    Baseline
                                </option>
                                <option value="One-Off"
                                    {{ $kpi->expenditure_2026 == 'One-Off' ? 'selected' : '' }}>
                                    One-Off
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>K1</strong> - Perbelanjaan tahunan berkeutamaan tinggi (kontrak berjalan / projek one-off berjalan).<br><br>
                            <strong>K2</strong> - Perbelanjaan tidak berkontrak atau pembaharuan kontrak yang boleh dikemaskini.<br><br>
                            <strong>K3</strong> - Perbelanjaan baru atau cadangan (one-off / planning stage).
                            ">
                            </i></label>
                            <select name="priority_2026" class="form-select">
                                <option value="">Select Priority</option>
                                <option value="K1"
                                    {{ $kpi->priority_2026 == 'K1' ? 'selected' : '' }}>
                                    K1 (Priority / Keutamaan 1)
                                </option>
                                <option value="K2"
                                    {{ $kpi->priority_2026 == 'K2' ? 'selected' : '' }}>
                                    K2 (Priority / Keutamaan 2)
                                </option>
                                <option value="K3"
                                    {{ $kpi->priority_2026 == 'K3' ? 'selected' : '' }}>
                                    K3 (Priority / Keutamaan 3)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif) <i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Dalam perancangan (Baru)</strong> - Proposal, Evaluation, Planning Stage, Technical Completion.<br><br>
                            <strong>Proses tawaran</strong> - Procurement / Tender Stage.<br><br>
                            <strong>Dalam pelaksanaan</strong> - Additional Budget Request, Design Stage, Implementation Stage.
                            ">
                            </i></label>
                            <select name="project_status_2026" class="form-select">
                                <option value="">Select Status</option>

                                <option value="Dalam Perancangan (Baru)"
                                    {{ $kpi->project_status_2026 == 'Dalam Perancangan (Baru)' ? 'selected' : '' }}>
                                    Dalam Perancangan (Baru)
                                </option>

                                <option value="Proses Tawaran"
                                    {{ $kpi->project_status_2026 == 'Proses Tawaran' ? 'selected' : '' }}>
                                    Proses Tawaran
                                </option>

                                <option value="Dalam Pelaksanaan"
                                    {{ $kpi->project_status_2026 == 'Dalam Pelaksanaan' ? 'selected' : '' }}>
                                    Dalam Pelaksanaan
                                </option>

                                <option value="Selesai"
                                    {{ $kpi->project_status_2026 == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>
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
                            <input type="number" id="approved_budget_2026" name="approved_budget_2026" class="form-control"
                                value="{{ $kpi->approved_budget_2026 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2026)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" id="po_2026" name="po_2026" class="form-control"
                                value="{{ $kpi->po_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" id="contract_2026" name="contract_2026" class="form-control"
                                value="{{ $kpi->contract_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" id="journal_2026" name="journal_2026" class="form-control"
                                value="{{ $kpi->journal_2026 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_expenditure_2026" name="total_expenditure_2026" class="form-control"
                                value="{{ $kpi->total_expenditure_2026 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_percentage_2026" name="total_percentage_2026" class="form-control"
                                value="{{ $kpi->total_percentage_2026 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_expenditure_2026" class="form-control"
                                value="{{ $kpi->date_expenditure_2026 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_balance_2026" name="total_balance_2026" class="form-control"
                                value="{{ $kpi->total_balance_2026 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_balance_percentage_2026" name="total_balance_percentage_2026" class="form-control"
                                value="{{ $kpi->total_balance_percentage_2026 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_balance_2026" class="form-control"
                                value="{{ $kpi->date_balance_2026 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q1_2026" name="target_q1_2026" class="form-control"
                                value="{{ $kpi->target_q1_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q1_2026" name="actual_q1_2026" class="form-control"
                                value="{{ $kpi->actual_q1_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q1_2026" name="rag_q1_2026" class="form-control"
                                value="{{ $kpi->rag_q1_2026 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q2_2026" name="target_q2_2026" class="form-control"
                                value="{{ $kpi->target_q2_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q2_2026" name="actual_q2_2026" class="form-control"
                                value="{{ $kpi->actual_q2_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q2_2026" name="rag_q1_2026" class="form-control"
                                value="{{ $kpi->rag_q2_2026 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q3_2026" name="target_q3_2026" class="form-control"
                                value="{{ $kpi->target_q3_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q3_2026" name="actual_q3_2026" class="form-control"
                                value="{{ $kpi->actual_q3_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q3_2026" name="rag_q3_2026" class="form-control"
                                value="{{ $kpi->rag_q3_2026 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q4_2026" name="target_q4_2026" class="form-control"
                                value="{{ $kpi->target_q4_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q4_2026" name="actual_q3_2026"  class="form-control"
                                value="{{ $kpi->actual_q4_2026 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q4_2026" name="rag_q4_2026" class="form-control"
                                value="{{ $kpi->rag_q4_2026 ?? 'Not yet started' }}" readonly>
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
                            <input type="text" id="actual_2027" name="actual_2027" class="form-control"
                                value="{{ $kpi->actual_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Annual Target (2027)</label>
                            <input type="text" id="target_2027" name="target_2027" class="form-control"
                                value="{{ $kpi->target_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Status RAG for KPI</label>
                            <input type="text" id="rag_2027" name="rag_2027" class="form-control"
                                value="{{ $kpi->rag_2027 }}" readonly>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Budget Type (2027)</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Budget Type (Jenis Peruntukan)</label>
                            <select name="budget_type_2027" class="form-select">
                                <option value="">Select Budget Type</option>
                                <option value="OCAR"
                                    {{ $kpi->budget_type_2027 == 'OCAR' ? 'selected' : '' }}>
                                    OCAR (Other Charges Annual Recurrent)
                                </option>
                                <option value="RKN"
                                    {{ $kpi->budget_type_2027 == 'RKN' ? 'selected' : '' }}>
                                    RKN (Rancangan Kemajuan Negara)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Financial Year (Tahun Kewangan)</label>
                            <select name="financial_year_2027" class="form-select select2">
                                <option value="">Select Financial Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}"
                                        {{ $kpi->financial_year_2027 == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Account No & Title (No. & Tajuk Akaun)</label>
                            <select name="account_2027" class="form-select">
                                <option value="">Select Account</option>
                                <option value="2108"
                                    {{ $kpi->account_2027 == '2108' ? 'selected' : '' }}>
                                    2108 - Teknologi Maklumat dan Info-Komunikasi
                                </option>
                                <option value="2109"
                                    {{ $kpi->account_2027 == '2109' ? 'selected' : '' }}>
                                    2109 - Perkhidmatan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Expenditure Type (Jenis Perbelanjaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Baseline</strong> - Peruntukan sebenar operasi untuk menjalankan core business Kementerian dan Jabatan masing-masing.<br><br>
                            Ini termasuk pemeliharaan aset Kerajaan bagi mengelakkan kerosakan dan kerugian.<br><br>
                            <strong>One-off</strong> – One-off Project.
                            ">
                            </i></label>
                            <select name="expenditure_2027" class="form-select">
                                <option value="">Select Type</option>
                                <option value="Baseline"
                                    {{ $kpi->expenditure_2027 == 'Baseline' ? 'selected' : '' }}>
                                    Baseline
                                </option>
                                <option value="One-Off"
                                    {{ $kpi->expenditure_2027 == 'One-Off' ? 'selected' : '' }}>
                                    One-Off
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Spending Priorities (Perbelanjaan menurut Keutamaan)<i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>K1</strong> - Perbelanjaan tahunan berkeutamaan tinggi (kontrak berjalan / projek one-off berjalan).<br><br>
                            <strong>K2</strong> - Perbelanjaan tidak berkontrak atau pembaharuan kontrak yang boleh dikemaskini.<br><br>
                            <strong>K3</strong> - Perbelanjaan baru atau cadangan (one-off / planning stage).
                            ">
                            </i></label>
                            <select name="priority_2027" class="form-select">
                                <option value="">Select Priority</option>
                                <option value="K1"
                                    {{ $kpi->priority_2027 == 'K1' ? 'selected' : '' }}>
                                    K1 (Priority / Keutamaan 1)
                                </option>
                                <option value="K2"
                                    {{ $kpi->priority_2027 == 'K2' ? 'selected' : '' }}>
                                    K2 (Priority / Keutamaan 2)
                                </option>
                                <option value="K3"
                                    {{ $kpi->priority_2027 == 'K3' ? 'selected' : '' }}>
                                    K3 (Priority / Keutamaan 3)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Project / Programme / Initiative Status (Status Projek / Program / Inisiatif) <i class="bi bi-info-circle text-primary ms-1"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            title="
                            <strong>Dalam perancangan (Baru)</strong> - Proposal, Evaluation, Planning Stage, Technical Completion.<br><br>
                            <strong>Proses tawaran</strong> - Procurement / Tender Stage.<br><br>
                            <strong>Dalam pelaksanaan</strong> - Additional Budget Request, Design Stage, Implementation Stage.
                            ">
                            </i></label>
                            <select name="project_status_2027" class="form-select">
                                <option value="">Select Status</option>

                                <option value="Dalam Perancangan (Baru)"
                                    {{ $kpi->project_status_2027 == 'Dalam Perancangan (Baru)' ? 'selected' : '' }}>
                                    Dalam Perancangan (Baru)
                                </option>

                                <option value="Proses Tawaran"
                                    {{ $kpi->project_status_2027 == 'Proses Tawaran' ? 'selected' : '' }}>
                                    Proses Tawaran
                                </option>

                                <option value="Dalam Pelaksanaan"
                                    {{ $kpi->project_status_2027 == 'Dalam Pelaksanaan' ? 'selected' : '' }}>
                                    Dalam Pelaksanaan
                                </option>

                                <option value="Selesai"
                                    {{ $kpi->project_status_2027 == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>
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
                            <input type="number" id="approved_budget_2027" name="approved_budget_2027" class="form-control"
                                value="{{ $kpi->approved_budget_2027 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Expenditure Details (2027)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>1 - Purchase Order (BND)</label>
                            <input type="number" id="po_2027" name="po_2027" class="form-control"
                                value="{{ $kpi->po_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>2 - Contract Modules (BND)</label>
                            <input type="number" id="contract_2027" name="contract_2027" class="form-control"
                                value="{{ $kpi->contract_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>3 - Direct/Journal Voucher (BND)</label>
                            <input type="number" id="journal_2027" name="journal_2027" class="form-control"
                                value="{{ $kpi->journal_2027 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Expenditure [1+2+3]</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_expenditure_2027" name="total_expenditure_2027" class="form-control"
                                value="{{ $kpi->total_expenditure_2027 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_percentage_2027" name="total_percentage_2027" class="form-control"
                                value="{{ $kpi->total_percentage_2027 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_expenditure_2027" class="form-control"
                                value="{{ $kpi->date_expenditure_2027 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">Total Balance (Jumlah Baki)</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Amount (BND)</label>
                            <input type="number" id="total_balance_2027" name="total_balance_2027" class="form-control"
                                value="{{ $kpi->total_balance_2027 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Percentage (%)</label>
                            <input type="number" id="total_balance_percentage_2027" name="total_balance_percentage_2027" class="form-control"
                                value="{{ $kpi->total_balance_percentage_2027 }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>As of (Setakat)</label>
                            <input type="date" name="date_balance_2027" class="form-control"
                                value="{{ $kpi->date_balance_2027 }}">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary">RAG Status for KPI Expenditure by Quarter</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q1 (Apr - June)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q1_2027" name="target_q1_2027" class="form-control"
                                value="{{ $kpi->target_q1_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q1_2027" name="actual_q1_2027" class="form-control"
                                value="{{ $kpi->actual_q1_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q1_2027" name="rag_q1_2027" class="form-control"
                                value="{{ $kpi->rag_q1_2027 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q2 (Jul - Sept)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q2_2027" name="target_q2_2027" class="form-control"
                                value="{{ $kpi->target_q2_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q2_2027" name="actual_q2_2027" class="form-control"
                                value="{{ $kpi->actual_q2_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q2_2027" name="rag_q1_2027" class="form-control"
                                value="{{ $kpi->rag_q2_2027 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q3 (Oct - Dec)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q3_2027" name="target_q3_2027" class="form-control"
                                value="{{ $kpi->target_q3_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q3_2027" name="actual_q3_2027" class="form-control"
                                value="{{ $kpi->actual_q3_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q3_2027" name="rag_q3_2027" class="form-control"
                                value="{{ $kpi->rag_q3_2027 ?? 'Not yet started' }}" readonly>
                        </div>

                    </div>

                    <br>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label>Q4 (Jan - Mac)</label><br>
                            <label>Target</label>
                            <input type="number" id="target_q4_2027" name="target_q4_2027" class="form-control"
                                value="{{ $kpi->target_q4_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Actual</label>
                            <input type="number" id="actual_q4_2027" name="actual_q3_2027"  class="form-control"
                                value="{{ $kpi->actual_q4_2027 }}">
                        </div>

                        <div class="col-md-4">
                            <label>RAG</label>
                            <input type="text" id="rag_q4_2027" name="rag_q4_2027" class="form-control"
                                value="{{ $kpi->rag_q4_2027 ?? 'Not yet started' }}" readonly>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

<script>
$(document).ready(function() {

    // Initialize ALL select2 normally
    $('.select2').select2({
        placeholder: "Select Financial Year",
        allowClear: true,
        width: '100%'
    });

    // Fix for ALL accordion items
    $('.accordion-collapse').on('shown.bs.collapse', function () {
        $(this).find('.select2').each(function () {
            $(this).select2({
                placeholder: "Select Financial Year",
                allowClear: true,
                width: '100%',
                dropdownParent: $(this).parent()
            });
        });
    });

});
</script>

<script>
$(document).ready(function() {

    function initSelect2(parent) {
        parent.find('.select2').each(function () {
            if ($(this).hasClass("select2-hidden-accessible")) {
                $(this).select2('destroy');
            }

            $(this).select2({
                placeholder: "Select Financial Year",
                allowClear: true,
                width: '100%',
                dropdownParent: parent
            });
        });
    }

    // Run once for visible elements
    initSelect2($(document));

    // Run when any accordion opens
    $('.accordion-collapse').on('shown.bs.collapse', function () {
        initSelect2($(this));
    });

});
</script>

<script>
function calculateYear(year) {

    // ===== EXPENDITURE =====
    let po = parseFloat(document.getElementById(`po_${year}`)?.value) || 0;
    let contract = parseFloat(document.getElementById(`contract_${year}`)?.value) || 0;
    let journal = parseFloat(document.getElementById(`journal_${year}`)?.value) || 0;
    let budget = parseFloat(document.getElementById(`approved_budget_${year}`)?.value) || 0;

    let total = po + contract + journal;

    let totalEl = document.getElementById(`total_expenditure_${year}`);
    if (totalEl) totalEl.value = total > 0 ? total.toFixed(2) : '';

    // % Total Expenditure
    let percentage = 0;
    if (budget > 0 && total > 0) {
        percentage = (total / budget) * 100;
    }

    let percentEl = document.getElementById(`total_percentage_${year}`);
    if (percentEl) percentEl.value = percentage > 0 ? percentage.toFixed(2) : '';

    // ===== BALANCE =====
    let balanceEl = document.getElementById(`total_balance_${year}`);
    let balancePercentEl = document.getElementById(`total_balance_percentage_${year}`);

    if (budget > 0 && total > 0) {
        let balance = budget - total;
        let balancePercent = 100 - percentage;

        if (balanceEl) balanceEl.value = balance.toFixed(2);
        if (balancePercentEl) balancePercentEl.value = balancePercent.toFixed(2);
    } else {
        if (balanceEl) balanceEl.value = '';
        if (balancePercentEl) balancePercentEl.value = '';
    }

    // ===== KPI RAG (YEARLY) =====
    let actual = parseFloat(document.getElementById(`actual_${year}`)?.value) || 0;
    let target = parseFloat(document.getElementById(`target_${year}`)?.value) || 0;
    let ragEl = document.getElementById(`rag_${year}`);

    if (ragEl) {
        if (actual === 0 || target === 0) {
            ragEl.value = 'Not yet started';
            ragEl.style.backgroundColor = '#ffffff';
        } else {
            let ragPercent = (actual / target) * 100;

            if (ragPercent >= 80) {
                ragEl.value = 'On-track (with no issues)';
                ragEl.style.backgroundColor = '#d4edda';
            } else if (ragPercent >= 50) {
                ragEl.value = 'On-track (with issues)';
                ragEl.style.backgroundColor = '#fff3cd';
            } else if (ragPercent >= 1) {
                ragEl.value = 'Need attention';
                ragEl.style.backgroundColor = '#f8d7da';
            } else {
                ragEl.value = 'Not yet started';
                ragEl.style.backgroundColor = '#ffffff';
            }
        }
    }

    // ===== QUARTERLY RAG =====
    const quarters = ['q1', 'q2', 'q3', 'q4'];

    quarters.forEach(q => {
        let qTarget = parseFloat(document.getElementById(`target_${q}_${year}`)?.value) || 0;
        let qActual = parseFloat(document.getElementById(`actual_${q}_${year}`)?.value) || 0;
        let qRagEl = document.getElementById(`rag_${q}_${year}`);

        if (!qRagEl) return;

        if (qTarget <= 0) {
            qRagEl.value = 'Not yet started';
            qRagEl.style.backgroundColor = '#ffffff';
            return;
        }

        let qPercent = (qActual / qTarget) * 100;

        if (qPercent === 0) {
            qRagEl.value = 'Not yet started';
            qRagEl.style.backgroundColor = '#ffffff';
        } else if (qPercent >= 1 && qPercent <= 74) {
            qRagEl.value = 'Need attention';
            qRagEl.style.backgroundColor = '#f8d7da';
        } else if (qPercent >= 75 && qPercent <= 99) {
            qRagEl.value = 'On-track (with issues)';
            qRagEl.style.backgroundColor = '#fff3cd';
        } else if (qPercent >= 100) {
            qRagEl.value = 'On-track (with no issues)';
            qRagEl.style.backgroundColor = '#d4edda';
        }
    });
}


// ===== APPLY TO ALL YEARS =====
const years = [2023, 2024, 2025, 2026, 2027];

years.forEach(year => {

    // Year-level inputs
    ['po', 'contract', 'journal', 'approved_budget', 'actual', 'target']
    .forEach(field => {
        let el = document.getElementById(`${field}_${year}`);
        if (el) {
            el.addEventListener('input', () => calculateYear(year));
        }
    });

    // Quarter inputs
    const quarters = ['q1', 'q2', 'q3', 'q4'];

    quarters.forEach(q => {
        ['target', 'actual'].forEach(field => {
            let el = document.getElementById(`${field}_${q}_${year}`);
            if (el) {
                el.addEventListener('input', () => calculateYear(year));
            }
        });
    });

    // Run on load
    calculateYear(year);
});
</script>

</body>
</html>