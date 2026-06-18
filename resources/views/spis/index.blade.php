<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPIS Dashboard</title>

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
    <a href="{{ route('spis.index') }}" class="menu-item active"><i class="bi bi-bar-chart"></i> Dashboard</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Pelan Strategik</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Green Education Plan</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Digital Transformation Plan</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Manpower Blueprint</a>
    <a href="{{ route('spis.pelan.index') }}" class="menu-item"><i class="bi bi-folder"></i> Wawasan Brunei 2035-Matlamat 1</a>
</div>

<!-- MAIN CONTENT -->
<div class="container-fluid px-4 py-4 flex-fill">

    <!-- Welcome Section -->
    <div class="card shadow-sm welcome-box mb-4">
        <div class="card-body">

            <h3 class="fw-bold text-primary">
                <i class="bi bi-bar-chart-line"></i>
                Welcome to Strategic Performance Information System
            </h3>

            <p class="text-muted">
                Comprehensive KPI management with advanced tracking and reporting capabilities
            </p>

            <div class="row g-3 mt-2">

                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="text-primary">
                                <i class="bi bi-bullseye"></i> Comprehensive Forms
                            </h5>
                            <p class="small text-muted">
                                Detailed KPI tracking with organized tabs covering ID, Baseline,
                                Information, Budget, and Deliverables
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="text-primary">
                                <i class="bi bi-folder2-open"></i> Multi-Folder Structure
                            </h5>
                            <p class="small text-muted">
                                Organize KPIs across Pelan Strategik, Green Education,
                                Digital Transformation, Manpower Blueprint, and Wawasan Brunei 2035
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="text-primary">
                                <i class="bi bi-graph-up-arrow"></i> Reports & Analytics
                            </h5>
                            <p class="small text-muted">
                                Generate detailed reports with full descriptive text and visualize trends
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Empty KPI Section -->
    <div class="card shadow-sm empty-box text-center py-5">
        <div class="card-body">
            <i class="bi bi-bar-chart fs-1 text-primary"></i>

            <h4 class="mt-3">No KPIs Added Yet</h4>

            <p class="text-muted">
                Navigate to any folder above to start adding your first strategic KPI
            </p>

            <div class="mt-3">
                <span class="badge-custom">KPI Forms</span>
                <span class="badge-custom">Multiple Fields</span>
                <span class="badge-custom">Organized Tabs</span>
                <span class="badge-custom">RAG Status Tracking</span>
                <span class="badge-custom">Report Generation</span>
            </div>
        </div>
    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    Strategic Performance Information System © 2026 | Powered By DevOps
</div>

</body>
</html>