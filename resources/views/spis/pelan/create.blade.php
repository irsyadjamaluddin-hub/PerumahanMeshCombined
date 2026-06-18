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

        .select2-container .select2-selection--single {
            height: 38px;
            padding: 5px 10px;
        }

        .select2-selection__rendered {
            line-height: 26px !important;
        }

        .select2-selection__arrow {
            height: 36px !important;
        }

        .select2-dropdown {
            border-radius: 8px;
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
            <form method="POST" action="{{ route('kpi.store') }}">
                @csrf

                <div class="row g-4">

                    <!-- LEFT -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Owner (Pemilik) *</label>
                        <select name="owner" class="form-select searchable">
                            <option>Select KPI owner...</option>
                            <option>Office of Minister of Education</option> 
                            <option>Office of Permanent Secretary (Higher Education)</option> 
                            <option>Office of Permanent Secretary (Core Education)</option>
                            <option>Office of Deputy Permanent Secretary (Higher Education)</option>
                            <option>Office of Deputy Permanent Secretary (Core Education)</option>
                            <option>Office of Deputy Permanent Secretary (Policy and Corporate)</option>
                            <option>Universiti Brunei Darussalam (UBD)</option>
                            <option>Universiti Islam Sultan Sharif Ali (UNISSA)</option>
                            <option>Universiti Teknologi Brunei (UTB)</option>
                            <option>Institute of Brunei Technical Education (IBTE)</option>
                            <option>Politeknik Brunei</option>
                            <option>Department of Higher Education</option>
                            <option>Department of Planning and Estate Management</option>
                            <option>Department of Information and Communication Technology</option>
                            <option>Department of Scholarship Management</option>
                            <option>SEAMEO VOCTECH Regional Centre</option>
                            <option>Lifelong Learning Centre (L3)</option>
                            <option>Secretariat of Brunei Darussalam National Accreditation Council (MKPK)</option>
                            <option>Internal Audit Unit (Quality Assurance)</option>
                            <option>Department of Schools</option>
                            <option>Department of Administration and Services</option>
                            <option>Department of Examinations</option>
                            <option>Department of Schools Inspectorate</option>
                            <option>Department of Curriculum Development</option>
                            <option>Department of Co-Curriculum Education</option>
                            <option>Department of Private Education</option>
                            <option>Department of Educators Management</option>
                            <option>Department of Special Education</option>
                            <option>Science, Technology and Environment Partnership Centre (STEP)</option>
                            <option>Entrepreneurship Innovation Centre (EIC)</option>
                            <option>Education Technology Centre (EduTech)</option>
                            <option>Counselling Division</option>
                            <option>Departments of Planning, Development and Research</option>
                            <option>Corporate Communications Division</option>
                            <option>International Relations Division</option>
                            <option>Secretariat of National Education Council (MPK)</option>
                            <option>Strategic Enterprise Performance and Delivery Unit (SEPaDU)</option>
                            <option>Legal Unit</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Goal/Cross Cutting Enablers *</label>
                        <select name="goal" class="form-select">
                            <option>Select goal or enabler...</option>
                            <option>Goal 1 - Nurture Future-Ready Learners</option>
                            <option>Goal 2 - Enhance Innovative Education Ecosystems</option>
                            <option>Goal 3 - Build up Human Resources</option>
                            <option>Cross Cutting Enablers CC1 High-quality Facilities and infrastructure</option>
                            <option>Cross Cutting Enablers CC2 Innovative Technology infrastructure through Digital Transformation</option>
                            <option>Cross Cutting Enablers CC3 Effective Governance and Policies</option>
                            <option>Cross Cutting Enablers CC4 Continuous Innovation through Research development and foresight</option>
                            <option>Cross Cutting Enablers CC5 Stakeholder Involvement and Internationalisation</option>
                            <option>Cross Cutting Enablers CC6 Financial Sustainability</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">KPI Title (Tajuk) *</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter KPI title...">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Strategic Objectives (SO) *</label>
                        <select name="strategic_objective" class="form-select">
                            <option>Select strategic objective...</option>
                            <option>N/A</option>
                            <option>SO1.1 - Raise student learning outcomes</option>
                            <option>SO1.2 - Strengthen students' future-ready skills</option>
                            <option>SO1.3 - Strengthen students' education foundation</option>
                            <option>SO1.4 - Nurture entrepreneurialism in learners</option>
                            <option>SO1.5 - Strengthen ethics and integrity</option>
                            <option>SO1.6 - Inculcate Lifelong learning culture</option>
                            <option>SO1.7 - Strengthen skills, mastery and competencies</option>
                            <option>SO2.1 - Strengthen teaching and learning practices</option>
                            <option>SO2.2 - Enhance curriculum and assessment</option>
                            <option>SO2.3 - Improve and innovate teaching, learning, research environment</option>
                            <option>SO2.4 - Increase research and innovation</option>
                            <option>SO3.1 - Strengthen workforce competency</option>
                            <option>SO3.2 - Strengthen human resource management</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">KPI Blueprint/Plan Link *</label>
                        <select name="blueprint_link[]" class="form-select searchable" multiple>
                            <option>Select KPI Blueprint/Plan...</option>
                            <option>N/A</option>
                            <option>Wawasan Brunei 2035 – Matlamat 1 - NKPI 2 - % students achieving 5 credits and above in GCE 'O' Level/ IGCSE</option>
                            <option>Wawasan Brunei 2035 – Matlamat 1 - NKPI 3 - % GER to Post Secondary (17-18)</option>
                            <option>Wawasan Brunei 2035 – Matlamat 1 - NKPI 5 - % Graduate employment rate in 5 sectors</option>
                            <option>Wawasan Brunei 2035 – Matlamat 1 - NKPI 6 - % Employer satisfaction (skills) rate</option>
                            <option>Manpower Blueprint - AKPI 1.1 - % student 5 A-C in PSR</option>
                            <option>Manpower Blueprint - AKPI 1.4 – Kadar pengambilan pelajar kasar pendidikan tertiari</option>
                            <option>Manpower Blueprint - AKPI 1.5 - % Pengijazahan TVET atau sebanding dan ke atas</option>
                            <option>Manpower Blueprint - AKPI 1.6 - # kolaborasi di antara institusi pendidikan tinggi tempatan dan institusi/agensi luar negeri</option>
                            <option>Manpower Blueprint - AKPI 1.7 – % pelajar institusi Pendidikan tinggi tempatan dengan kemahiran dalam teknologi baharu (emerging technologies) dan kelestarian (sustainability)</option>
                            <option>Manpower Blueprint - AKPI 2.1 - % Graduan dalam bidang Sains dan Kejuruteraan pada BDQF Tahan 6 dan ke atas</option>
                            <option>Manpower Blueprint - AKPI 2.7 - % sekolah rendah dan menengah yang mencapai minima tahap Gred 3 (aktif) dalam Program Sahsiah Pelajar (PSP)</option>
                            <option>Manpower Blueprint - AKPI 2.8 – # insiden atau kes disiplin bagi buli, pergaduhan dan penyalahgunaan dadah dalam kalangan pelajar institusi pendidikan tempatan</option>
                            <option>Manpower Blueprint - AKPI 3.4 – Kadar kebolehkerjaan graduan</option>
                            <option>Manpower Blueprint - AKPI 3.6 - % Belia berumur 15 ke 24 tahun Yang Dikategorikan Sebagai NEET (Not in Employment, Education or Training)</option>
                            <option>Manpower Blueprint - AKPI 4.1 – Kadar perbelanjaan institusi pengajian tinggi tempatan bagi kegiatan penyelidikan</option>
                            <option>Manpower Blueprint - AKPI 4.3 – Indeks Kesediaan Smart Education Readiness Index (SERI)</option>
                            <option>Digital Transformation Plan - KPI 1</option>
                            <option>Digital Transformation Plan - KPI 2</option>
                            <option>Digital Transformation Plan - KPI 3</option> 
                            <option>Green Education Plan - KPI 1</option>
                            <option>Green Education Plan - KPI 2</option>
                            <option>Green Education Plan - KPI 3</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Key Result Areas (KRA) *</label>
                        <select name="kra[]" class="form-select searchable" multiple>
                            <option>Select key result areas...</option>
                            <option>N/A</option>
                            <option>Student Learning and Achievement</option>
                            <option>Literacy and Numeracy</option>
                            <option>Access, Participation and Equity</option>
                            <option>Student Guidance</option>
                            <option>Special Education Needs</option>
                            <option>21st Century Competencies and STEAM</option>
                            <option>Character, Value and Citizenship Development</option>
                            <option>Sustainability and Innovation</option>
                            <option>Early Childhood Education</option>
                            <option>Student Learning Support</option>
                            <option>Student Welfare and Well-being</option>
                            <option>Entrepreneurism</option>
                            <option>Ethics and Integrity</option>
                            <option>Lifelong Learning Culture</option>
                            <option>Skills, Mastery and Competency</option>
                            <option>Teaching and Learning Quality</option>
                            <option>Curriculum Enhancement</option>
                            <option>Assessment Enhancement</option>
                            <option>Research and innovation</option>
                            <option>Continuous Professional Development</option>
                            <option>School Leadership Capacity</option>
                            <option>Teacher Welfare and Well-being</option>
                            <option>Workforce Planning and Deployment</option>
                        </select>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 text-end">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-plus-circle"></i> Add KPI
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
        $('.searchable').select2({
            placeholder: "Search or select option...",
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });
    });
</script>

</body>
</html>