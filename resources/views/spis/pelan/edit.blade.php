<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPIS Pelan Strategik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #cfe0ff;
            border-radius: 10px;
            background-color: #f5f9ff;
            padding: 6px;
            min-height: 38px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .select2-selection__choice {
            background: #e9eef5 !important;
            border: none !important;
            color: #333 !important;
            border-radius: 20px !important;
            padding: 5px 10px !important;
            font-size: 0.8rem;
            white-space: normal !important;
            word-break: break-word;
        }

        .select2-selection__rendered {
            display: flex !important;
            flex-wrap: wrap;
            gap: 4px;
        }

        .select2-results__option {
            white-space: normal;
        }

        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #cfe0ff;
            border-radius: 10px;
            background-color: #f5f9ff;
            padding: 5px 10px;
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
                Add New KPI - Pelan Strategik
            </div>
            <small class="text-muted">
                Fill in the KPI details. Performance and Budget will be available after approval.
            </small>
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
                    KPI
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

                <div class="row g-4">

                    <!-- LEFT -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Owner (Pemilik) *</label>
                        <select name="owner" class="form-select searchable-single">
                            <option {{ $kpi->owner == 'Office of Minister of Education' ? 'selected' : '' }}>Office of Minister of Education</option> 
                            <option {{ $kpi->owner == 'Office of Permanent Secretary (Higher Education)' ? 'selected' : '' }}>Office of Permanent Secretary (Higher Education)</option> 
                            <option {{ $kpi->owner == 'Office of Permanent Secretary (Core Education)' ? 'selected' : '' }}>Office of Permanent Secretary (Core Education)</option>
                            <option {{ $kpi->owner == 'Office of Deputy Permanent Secretary (Higher Education)' ? 'selected' : '' }}>Office of Deputy Permanent Secretary (Higher Education)</option>
                            <option {{ $kpi->owner == 'Office of Deputy Permanent Secretary (Core Education)' ? 'selected' : '' }}>Office of Deputy Permanent Secretary (Core Education)</option>
                            <option {{ $kpi->owner == 'Office of Deputy Permanent Secretary (Policy and Corporate)' ? 'selected' : '' }}>Office of Deputy Permanent Secretary (Policy and Corporate)</option>
                            <option {{ $kpi->owner == 'Universiti Brunei Darussalam (UBD)' ? 'selected' : '' }}>Universiti Brunei Darussalam (UBD)</option>
                            <option {{ $kpi->owner == 'Universiti Islam Sultan Sharif Ali (UNISSA)' ? 'selected' : '' }}>Universiti Islam Sultan Sharif Ali (UNISSA)</option>
                            <option {{ $kpi->owner == 'Universiti Teknologi Brunei (UTB)' ? 'selected' : '' }}>Universiti Teknologi Brunei (UTB)</option>
                            <option {{ $kpi->owner == 'Institute of Brunei Technical Education (IBTE)' ? 'selected' : '' }}>Institute of Brunei Technical Education (IBTE)</option>
                            <option {{ $kpi->owner == 'Politeknik Brunei' ? 'selected' : '' }}>Politeknik Brunei</option>
                            <option {{ $kpi->owner == 'Department of Higher Education' ? 'selected' : '' }}>Department of Higher Education</option>
                            <option {{ $kpi->owner == 'Department of Planning and Estate Management' ? 'selected' : '' }}>Department of Planning and Estate Management</option>
                            <option {{ $kpi->owner == 'Department of Information and Communication Technology' ? 'selected' : '' }}>Department of Information and Communication Technology</option>
                            <option {{ $kpi->owner == 'Department of Scholarship Management' ? 'selected' : '' }}>Department of Scholarship Management</option>
                            <option {{ $kpi->owner == 'SEAMEO VOCTECH Regional Centre' ? 'selected' : '' }}>SEAMEO VOCTECH Regional Centre</option>
                            <option {{ $kpi->owner == 'Lifelong Learning Centre (L3)' ? 'selected' : '' }}>Lifelong Learning Centre (L3)</option>
                            <option {{ $kpi->owner == 'Secretariat of Brunei Darussalam National Accreditation Council (MKPK)' ? 'selected' : '' }}>Secretariat of Brunei Darussalam National Accreditation Council (MKPK)</option>
                            <option {{ $kpi->owner == 'Internal Audit Unit (Quality Assurance)' ? 'selected' : '' }}>Internal Audit Unit (Quality Assurance)</option>
                            <option {{ $kpi->owner == 'Department of Schools' ? 'selected' : '' }}>Department of Schools</option>
                            <option {{ $kpi->owner == 'Department of Administration and Services' ? 'selected' : '' }}>Department of Administration and Services</option>
                            <option {{ $kpi->owner == 'Department of Examinations' ? 'selected' : '' }}>Department of Examinations</option>
                            <option {{ $kpi->owner == 'Department of Schools Inspectorate' ? 'selected' : '' }}>Department of Schools Inspectorate</option>
                            <option {{ $kpi->owner == 'Department of Curriculum Development' ? 'selected' : '' }}>Department of Curriculum Development</option>
                            <option {{ $kpi->owner == 'Department of Co-Curriculum Education' ? 'selected' : '' }}>Department of Co-Curriculum Education</option>
                            <option {{ $kpi->owner == 'Department of Private Education' ? 'selected' : '' }}>Department of Private Education</option>
                            <option {{ $kpi->owner == 'Department of Educators Management' ? 'selected' : '' }}>Department of Educators Management</option>
                            <option {{ $kpi->owner == 'Department of Special Education' ? 'selected' : '' }}>Department of Special Education</option>
                            <option {{ $kpi->owner == 'Science, Technology and Environment Partnership Centre (STEP)' ? 'selected' : '' }}>Science, Technology and Environment Partnership Centre (STEP)</option>
                            <option {{ $kpi->owner == 'Entrepreneurship Innovation Centre (EIC)' ? 'selected' : '' }}>Entrepreneurship Innovation Centre (EIC)</option>
                            <option {{ $kpi->owner == 'Education Technology Centre (EduTech)' ? 'selected' : '' }}>Education Technology Centre (EduTech)</option>
                            <option {{ $kpi->owner == 'Counselling Division' ? 'selected' : '' }}>Counselling Division</option>
                            <option {{ $kpi->owner == 'Departments of Planning, Development and Research' ? 'selected' : '' }}>Departments of Planning, Development and Research</option>
                            <option {{ $kpi->owner == 'Corporate Communications Division' ? 'selected' : '' }}>Corporate Communications Division</option>
                            <option {{ $kpi->owner == 'International Relations Division' ? 'selected' : '' }}>International Relations Division</option>
                            <option {{ $kpi->owner == 'Secretariat of National Education Council (MPK)' ? 'selected' : '' }}>Secretariat of National Education Council (MPK)</option>
                            <option {{ $kpi->owner == 'Strategic Enterprise Performance and Delivery Unit (SEPaDU)' ? 'selected' : '' }}>Strategic Enterprise Performance and Delivery Unit (SEPaDU)</option>
                            <option {{ $kpi->owner == 'Legal Unit' ? 'selected' : '' }}>Legal Unit</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Goal/Cross Cutting Enablers *</label>
                        <select name="goal" class="form-select">
                            <option {{ $kpi->goal == 'Goal 1 - Nurture Future-Ready Learners' ? 'selected' : '' }}>Goal 1 - Nurture Future-Ready Learners</option>
                            <option {{ $kpi->goal == 'Goal 2 - Enhance Innovative Education Ecosystems' ? 'selected' : '' }}>Goal 2 - Enhance Innovative Education Ecosystems</option>
                            <option {{ $kpi->goal == 'Goal 3 - Build up Human Resources' ? 'selected' : '' }}>Goal 3 - Build up Human Resources</option>
                            <option {{ $kpi->goal == 'Cross Cutting Enablers CC1 High-quality Facilities and infrastructure' ? 'selected' : '' }}>Cross Cutting Enablers CC1 High-quality Facilities and infrastructure</option>
                            <option {{ $kpi->goal == 'Cross Cutting Enablers CC2 Innovative Technology infrastructure through Digital Transformation' ? 'selected' : '' }}>Cross Cutting Enablers CC2 Innovative Technology infrastructure through Digital Transformation</option>
                            <option {{ $kpi->goal == 'Cross Cutting Enablers CC3 Effective Governance and Policies' ? 'selected' : '' }}>Cross Cutting Enablers CC3 Effective Governance and Policies</option>
                            <option {{ $kpi->goal == 'Cross Cutting Enablers CC4 Continuous Innovation through Research development and foresight' ? 'selected' : '' }}>Cross Cutting Enablers CC4 Continuous Innovation through Research development and foresight</option>
                            <option {{ $kpi->goal == 'Cross Cutting Enablers CC5 Stakeholder Involvement and Internationalisation' ? 'selected' : '' }}>Cross Cutting Enablers CC5 Stakeholder Involvement and Internationalisation</option>
                            <option {{ $kpi->goal == 'Cross Cutting Enablers CC6 Financial Sustainability' ? 'selected' : '' }}>Cross Cutting Enablers CC6 Financial Sustainability</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">KPI Title (Tajuk) *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $kpi->title) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Strategic Objectives (SO) *</label>
                        <select name="strategic_objective" class="form-select">
                            <option {{ $kpi->strategic_objective == "N/A" ? 'selected' : '' }}>N/A</option>
                            <option {{ $kpi->strategic_objective == "SO1.1 - Raise student learning outcomes" ? 'selected' : '' }}>SO1.1 - Raise student learning outcomes</option>
                            <option {{ $kpi->strategic_objective == "SO1.2 - Strengthen students' future-ready skills"? 'selected' : '' }}>SO1.2 - Strengthen students' future-ready skills</option>
                            <option {{ $kpi->strategic_objective == "SO1.3 - Strengthen students' education foundation" ? 'selected' : '' }}>SO1.3 - Strengthen students' education foundation</option>
                            <option {{ $kpi->strategic_objective == "SO1.4 - Nurture entrepreneurialism in learners" ? 'selected' : '' }}>SO1.4 - Nurture entrepreneurialism in learners</option>
                            <option {{ $kpi->strategic_objective == "SO1.5 - Strengthen ethics and integrity" ? 'selected' : '' }}>SO1.5 - Strengthen ethics and integrity</option>
                            <option {{ $kpi->strategic_objective == "SO1.6 - Inculcate Lifelong learning culture" ? 'selected' : '' }}>SO1.6 - Inculcate Lifelong learning culture</option>
                            <option {{ $kpi->strategic_objective == "SO1.7 - Strengthen skills, mastery and competencies" ? 'selected' : '' }}>SO1.7 - Strengthen skills, mastery and competencies</option>
                            <option {{ $kpi->strategic_objective == "SO2.1 - Strengthen teaching and learning practices" ? 'selected' : '' }}>SO2.1 - Strengthen teaching and learning practices</option>
                            <option {{ $kpi->strategic_objective == "SO2.2 - Enhance curriculum and assessment" ? 'selected' : '' }}>SO2.2 - Enhance curriculum and assessment</option>
                            <option {{ $kpi->strategic_objective == "SO2.3 - Improve and innovate teaching, learning, research environment" ? 'selected' : '' }}>SO2.3 - Improve and innovate teaching, learning, research environment</option>
                            <option {{ $kpi->strategic_objective == "SO2.4 - Increase research and innovation" ? 'selected' : '' }}>SO2.4 - Increase research and innovation</option>
                            <option {{ $kpi->strategic_objective == "SO3.1 - Strengthen workforce competency" ? 'selected' : '' }}>SO3.1 - Strengthen workforce competency</option>
                            <option {{ $kpi->strategic_objective == "SO3.2 - Strengthen human resource management" ? 'selected' : '' }}>SO3.2 - Strengthen human resource management</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">KPI Blueprint/Plan Link *</label>
                        <select name="blueprint_link[]" class="form-select searchable-multiple" multiple>
                            @php
                                $blueprints = $kpi->blueprint_link ?? [];
                                if (is_string($blueprints)) {
                                    $decoded = json_decode($blueprints, true);
                                    $blueprints = is_array($decoded) ? $decoded : [];
                                }

                                $blueprintOptions = [
                                    "N/A",
                                    "Wawasan Brunei 2035 – Matlamat 1 - NKPI 2 - % students achieving 5 credits and above in GCE 'O' Level/ IGCSE",
                                    "Wawasan Brunei 2035 – Matlamat 1 - NKPI 3 - % GER to Post Secondary (17-18)",
                                    "Wawasan Brunei 2035 – Matlamat 1 - NKPI 5 - % Graduate employment rate in 5 sectors" ,
                                    "Wawasan Brunei 2035 – Matlamat 1 - NKPI 6 - % Employer satisfaction (skills) rate",
                                    "Manpower Blueprint - AKPI 1.1 - % student 5 A-C in PSR",
                                    "Manpower Blueprint - AKPI 1.4 – Kadar pengambilan pelajar kasar pendidikan tertiari",
                                    "Manpower Blueprint - AKPI 1.5 - % Pengijazahan TVET atau sebanding dan ke atas",
                                    "Manpower Blueprint - AKPI 1.6 - # kolaborasi di antara institusi pendidikan tinggi tempatan dan institusi/agensi luar negeri",
                                    "Manpower Blueprint - AKPI 1.7 – % pelajar institusi Pendidikan tinggi tempatan dengan kemahiran dalam teknologi baharu (emerging technologies) dan kelestarian (sustainability)",
                                    "Manpower Blueprint - AKPI 2.1 - % Graduan dalam bidang Sains dan Kejuruteraan pada BDQF Tahan 6 dan ke atas",
                                    "Manpower Blueprint - AKPI 2.7 - % sekolah rendah dan menengah yang mencapai minima tahap Gred 3 (aktif) dalam Program Sahsiah Pelajar (PSP)",
                                    "Manpower Blueprint - AKPI 2.8 – # insiden atau kes disiplin bagi buli, pergaduhan dan penyalahgunaan dadah dalam kalangan pelajar institusi pendidikan tempatan",
                                    "Manpower Blueprint - AKPI 3.4 – Kadar kebolehkerjaan graduan",
                                    "Manpower Blueprint - AKPI 3.6 - % Belia berumur 15 ke 24 tahun Yang Dikategorikan Sebagai NEET (Not in Employment, Education or Training)",
                                    "Manpower Blueprint - AKPI 4.1 – Kadar perbelanjaan institusi pengajian tinggi tempatan bagi kegiatan penyelidikan",
                                    "Manpower Blueprint - AKPI 4.3 – Indeks Kesediaan Smart Education Readiness Index (SERI)",
                                    "Digital Transformation Plan - KPI 1",
                                    "Digital Transformation Plan - KPI 2",
                                    "Digital Transformation Plan - KPI 3",
                                    "Green Education Plan - KPI 1",
                                    "Green Education Plan - KPI 2",
                                    "Green Education Plan - KPI 3",
                                 ];
                            @endphp
                            @foreach($blueprintOptions as $bp)
                                <option value="{{ $bp }}" {{ in_array($bp, $blueprints) ? 'selected' : '' }}>
                                    {{ $bp }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Key Result Areas (KRA) *</label>
                        <select name="kra[]" class="form-select searchable-multiple" multiple>
                            @php
                                $kras = $kpi->kra ?? [];
                                if (is_string($kras)) {
                                    $decoded = json_decode($kras, true);
                                    $kras = is_array($decoded) ? $decoded : [];
                                }

                                $kraOptions = [
                                    "N/A",
                                    "Student Learning and Achievement",
                                    "Literacy and Numeracy",
                                    "Access, Participation and Equity",
                                    "Student Guidance",
                                    "Special Education Needs",
                                    "21st Century Competencies and STEAM",
                                    "Character, Value and Citizenship Development",
                                    "Sustainability and Innovation",
                                    "Early Childhood Education",
                                    "Student Learning Support",
                                    "Student Welfare and Well-being",
                                    "Entrepreneurism",
                                    "Ethics and Integrity",
                                    "Lifelong Learning Culture",
                                    "Skills, Mastery and Competency",
                                    "Teaching and Learning Quality",
                                    "Curriculum Enhancement",
                                    "Assessment Enhancement",
                                    "Research and innovation",
                                    "Continuous Professional Development",
                                    "School Leadership Capacity",
                                    "Teacher Welfare and Well-being",
                                    "Workforce Planning and Deployment"
                                ];
                            @endphp
                            @foreach($kraOptions as $kra)
                                <option value="{{ $kra }}" {{ in_array($kra, $kras) ? 'selected' : '' }}>
                                    {{ $kra }}
                                </option>
                            @endforeach
                        </select>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('.searchable-single').select2({
        placeholder: "Select option...",
        allowClear: true,
        width: '100%'
    });

    $('.searchable-multiple').select2({
        placeholder: "Search and select options...",
        closeOnSelect: false,
        width: '100%'
    });

});
</script>

</body>
</html>