@extends('hrs.layouts.app-minimal')

@section('title', 'HRIDS Report Dashboard')

@section('content')

<div class="container-fluid py-4">
    
    {{-- Header --}}
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-2">Dashboard Sumber Manusia (Human Capital) {{ date('Y') }}</h1>
        <hr style="width: 128px; height: 4px; background: linear-gradient(to right, #dc2626, #2563eb); margin: 0 auto; border: none; border-radius: 2px;">
    </div>

    {{-- Toggle Buttons - ALWAYS AT TOP - 3 BUTTONS --}}
    <div style="display: flex; justify-content: center; gap: 16px; margin-bottom: 48px;">
        <button 
            id="btnAll"
            onclick="showTab('all')"
            style="padding: 12px 32px; font-size: 16px; font-weight: 600; border: 3px solid #6b7280; border-radius: 8px; cursor: pointer; background: #6b7280; color: white; box-shadow: 0 6px 16px rgba(107, 114, 128, 0.5); transition: all 0.3s ease; transform: scale(1.05);">
            <i class="bi bi-grid-3x3-gap-fill me-2"></i>All
        </button>
        
        <button 
            id="btnTeaching"
            onclick="showTab('teaching')"
            style="padding: 12px 32px; font-size: 16px; font-weight: 600; border: 3px solid #dc2626; border-radius: 8px; cursor: pointer; background: #dc2626; color: white; box-shadow: 0 2px 6px rgba(220, 38, 38, 0.3); transition: all 0.3s ease; opacity: 0.5;">
            <i class="bi bi-person-workspace me-2"></i>Teaching
        </button>
        
        <button 
            id="btnNonTeaching"
            onclick="showTab('nonteaching')"
            style="padding: 12px 32px; font-size: 16px; font-weight: 600; border: 3px solid #2563eb; border-radius: 8px; cursor: pointer; background: #2563eb; color: white; box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3); transition: all 0.3s ease; opacity: 0.5;">
            <i class="bi bi-people me-2"></i>Non-Teaching
        </button>
    </div>

    {{-- OVERVIEW SECTION - Shows when "All" is active --}}
    <div id="overviewSection" style="margin-bottom: 32px;">
        <div class="text-center mb-4">
            <h3 class="fw-bold" style="color: #374151;">Overall Staff Overview</h3>
            <p class="text-muted">Combined statistics for all staff members</p>
        </div>

        <div class="row mb-4">
            {{-- Overall Staff Distribution Chart --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #6b7280;">
                            <i class="bi bi-people-fill me-2"></i>Total Staff Distribution
                        </h5>
                        <div id="overallStaffChart"></div>
                    </div>
                </div>
            </div>

            {{-- Overall Gender Distribution Chart --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #6b7280;">
                            <i class="bi bi-gender-ambiguous me-2"></i>Overall Gender Distribution
                        </h5>
                        <div id="overallGenderChart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            {{-- Overall Daerah Distribution Chart --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #6b7280;">
                            <i class="bi bi-geo-alt me-2"></i>Overall Daerah Distribution
                        </h5>
                        <div id="overallDaerahChart"></div>
                    </div>
                </div>
            </div>

            {{-- Overall Kelulusan Distribution Chart --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #6b7280;">
                            <i class="bi bi-mortarboard me-2"></i>Overall Kelulusan Distribution (Top 5)
                        </h5>
                        <div id="overallKelulusanChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TEACHING CONTENT --}}
    <div id="teachingContent" style="display: none;">
        <div class="row mb-4">
            
            {{-- Total Teaching Staff Card --}}
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #dc2626;">
                            <i class="bi bi-person-workspace me-2"></i>Total Teaching Staff
                        </h5>

                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fee2e2;">
                                <i class="bi bi-people-fill" style="font-size: 24px; color: #dc2626;"></i>
                            </div>
                            <div class="ms-3">
                                <h3 class="fw-bold mb-0" style="color: #b91c1c;">{{ number_format($totalTeaching) }}</h3>
                                <span class="text-muted small">staff members</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            
            {{-- Teaching Gender Distribution --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #dc2626;">
                            <i class="bi bi-gender-ambiguous me-2"></i>Teaching Staff by Gender
                        </h5>
                        <div id="teachingGenderPieChart"></div>
                    </div>
                </div>
            </div>

            {{-- Teaching Staff by Kelulusan --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #dc2626;">
                            <i class="bi bi-mortarboard me-2"></i>Teaching Staff by Kelulusan
                        </h5>
                        <div id="teachingKelulusanChart"></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Teaching Daerah Distribution --}}
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #dc2626;">
                            <i class="bi bi-geo-alt me-2"></i>Teaching Staff by Daerah
                        </h5>
                        <div id="teachingDaerahChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NON-TEACHING CONTENT --}}
    <div id="nonTeachingContent" style="display: none;">
        <div class="row mb-4">
            
            {{-- Total Non-Teaching Staff Card --}}
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #2563eb;">
                            <i class="bi bi-people me-2"></i>Total Non-Teaching Staff
                        </h5>

                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #dbeafe;">
                                <i class="bi bi-people-fill" style="font-size: 24px; color: #2563eb;"></i>
                            </div>
                            <div class="ms-3">
                                <h3 class="fw-bold mb-0" style="color: #1d4ed8;">{{ number_format($totalNonTeaching) }}</h3>
                                <span class="text-muted small">staff members</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            
            {{-- Non-Teaching Gender Distribution --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #2563eb;">
                            <i class="bi bi-gender-ambiguous me-2"></i>Non-Teaching Staff by Gender
                        </h5>
                        <div id="nonTeachingGenderPieChart"></div>
                    </div>
                </div>
            </div>

            {{-- Non-Teaching Staff by Kelulusan --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #2563eb;">
                            <i class="bi bi-mortarboard me-2"></i>Non-Teaching Staff by Kelulusan
                        </h5>
                        <div id="nonTeachingKelulusanChart"></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Non-Teaching Daerah Distribution --}}
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #2563eb;">
                            <i class="bi bi-geo-alt me-2"></i>Non-Teaching Staff by Daerah
                        </h5>
                        <div id="nonTeachingDaerahChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<p class="text-center text-muted mt-5 mb-4 small">
    Ministry Of Education @ {{ date('Y') }} All Rights Reserved. Powered by DevOps ICT.
</p>

{{-- Load ApexCharts --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

{{-- Tab Switching Script --}}
<script>
    console.log('Script loaded successfully');
    
    function showTab(tab) {
        console.log('showTab function called with:', tab);
        
        var overviewSection = document.getElementById('overviewSection');
        var teachingContent = document.getElementById('teachingContent');
        var nonTeachingContent = document.getElementById('nonTeachingContent');
        var btnAll = document.getElementById('btnAll');
        var btnTeaching = document.getElementById('btnTeaching');
        var btnNonTeaching = document.getElementById('btnNonTeaching');
        
        console.log('Elements found:', {
            overviewSection: overviewSection,
            teachingContent: teachingContent,
            nonTeachingContent: nonTeachingContent,
            btnAll: btnAll,
            btnTeaching: btnTeaching,
            btnNonTeaching: btnNonTeaching
        });
        
        // Reset all buttons to inactive state
        btnAll.style.opacity = '0.5';
        btnAll.style.transform = 'scale(1)';
        btnAll.style.boxShadow = '0 2px 6px rgba(107, 114, 128, 0.3)';
        
        btnTeaching.style.opacity = '0.5';
        btnTeaching.style.transform = 'scale(1)';
        btnTeaching.style.boxShadow = '0 2px 6px rgba(220, 38, 38, 0.3)';
        
        btnNonTeaching.style.opacity = '0.5';
        btnNonTeaching.style.transform = 'scale(1)';
        btnNonTeaching.style.boxShadow = '0 2px 6px rgba(37, 99, 235, 0.3)';
        
        if (tab === 'all') {
            console.log('Switching to all');
            overviewSection.style.display = 'block';
            teachingContent.style.display = 'none';
            nonTeachingContent.style.display = 'none';
            
            // Activate All button
            btnAll.style.opacity = '1';
            btnAll.style.transform = 'scale(1.05)';
            btnAll.style.boxShadow = '0 6px 16px rgba(107, 114, 128, 0.5)';
            
        } else if (tab === 'teaching') {
            console.log('Switching to teaching');
            overviewSection.style.display = 'none';
            teachingContent.style.display = 'block';
            nonTeachingContent.style.display = 'none';
            
            // Activate Teaching button
            btnTeaching.style.opacity = '1';
            btnTeaching.style.transform = 'scale(1.05)';
            btnTeaching.style.boxShadow = '0 6px 16px rgba(220, 38, 38, 0.5)';
            
        } else if (tab === 'nonteaching') {
            console.log('Switching to non-teaching');
            overviewSection.style.display = 'none';
            teachingContent.style.display = 'none';
            nonTeachingContent.style.display = 'block';
            
            // Activate Non-Teaching button
            btnNonTeaching.style.opacity = '1';
            btnNonTeaching.style.transform = 'scale(1.05)';
            btnNonTeaching.style.boxShadow = '0 6px 16px rgba(37, 99, 235, 0.5)';
        }
        
        console.log('Tab switch complete');
    }
    
    // Test on page load
    console.log('Page loaded, testing button click');
</script>

{{-- ApexCharts Rendering --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log('DOM Content Loaded - Rendering charts');
        
        // ===== OVERVIEW CHARTS =====
        
        // 1. Overall Staff Distribution (Teaching vs Non-Teaching)
        new ApexCharts(document.querySelector("#overallStaffChart"), {
            series: [{{ $totalTeaching }}, {{ $totalNonTeaching }}],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: { show: true }
            },
            labels: ['Teaching Staff', 'Non-Teaching Staff'],
            colors: ['#dc2626', '#2563eb'],
            legend: { position: 'bottom' },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex];
                }
            },
            title: {
                text: 'Total: ' + ({{ $totalTeaching }} + {{ $totalNonTeaching }}).toLocaleString(),
                align: 'center',
                style: { fontSize: '14px', fontWeight: 'bold', color: '#6b7280' }
            }
        }).render();
        
        // 2. Overall Gender Distribution (Grouped Bar)
        new ApexCharts(document.querySelector("#overallGenderChart"), {
            series: [{
                name: 'Teaching',
                data: [{{ $teachingLelaki }}, {{ $teachingPerempuan }}]
            }, {
                name: 'Non-Teaching',
                data: [{{ $nonTeachingLelaki }}, {{ $nonTeachingPerempuan }}]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: true }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: ['Lelaki', 'Perempuan'],
            },
            colors: ['#dc2626', '#2563eb'],
            legend: {
                position: 'bottom'
            }
        }).render();
        
        // 3. Overall Daerah Distribution (Grouped Bar)
        new ApexCharts(document.querySelector("#overallDaerahChart"), {
            series: [{
                name: 'Teaching',
                data: [{{ $teachingBruneiMuara ?? 0 }}, {{ $teachingTutong ?? 0 }}, {{ $teachingKualaBelait ?? 0 }}, {{ $teachingTemburong ?? 0 }}]
            }, {
                name: 'Non-Teaching',
                data: [{{ $nonTeachingBruneiMuara ?? 0 }}, {{ $nonTeachingTutong ?? 0 }}, {{ $nonTeachingKualaBelait ?? 0 }}, {{ $nonTeachingTemburong ?? 0 }}]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: true }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: ['Brunei Muara', 'Tutong', 'Kuala Belait', 'Temburong'],
            },
            colors: ['#dc2626', '#2563eb'],
            legend: {
                position: 'bottom'
            }
        }).render();
        
        // 4. Overall Kelulusan Distribution (Top 5 - Grouped Bar)
        new ApexCharts(document.querySelector("#overallKelulusanChart"), {
            series: [{
                name: 'Teaching',
                data: [
                    {{ $teachingDegree ?? 0 }},
                    {{ $teachingMaster ?? 0 }},
                    {{ $teachingDiploma ?? 0 }},
                    {{ $teachingPGCE ?? 0 }},
                    {{ $teachingPhD ?? 0 }}
                ]
            }, {
                name: 'Non-Teaching',
                data: [
                    {{ $nonTeachingDegree ?? 0 }},
                    {{ $nonTeachingMaster ?? 0 }},
                    {{ $nonTeachingDiploma ?? 0 }},
                    {{ $nonTeachingPGCE ?? 0 }},
                    {{ $nonTeachingPhD ?? 0 }}
                ]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: true }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: ['Degree', 'Master', 'Diploma', 'PGCE', 'PhD'],
            },
            colors: ['#dc2626', '#2563eb'],
            legend: {
                position: 'bottom'
            }
        }).render();
        
        // ===== DETAILED CHARTS =====
        
        // Teaching Gender Pie Chart
        new ApexCharts(document.querySelector("#teachingGenderPieChart"), {
            series: [{{ $teachingLelaki }}, {{ $teachingPerempuan }}],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: { show: true }
            },
            labels: ['Lelaki', 'Perempuan'],
            colors: ['#dc2626', '#f87171'],
            legend: { position: 'bottom' },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex];
                }
            }
        }).render();
        
        // Teaching Kelulusan Bar Chart
        new ApexCharts(document.querySelector("#teachingKelulusanChart"), {
            series: [{
                name: 'Staff Count',
                data: [
                    {{ $teachingPhD ?? 0 }}, {{ $teachingPGCE ?? 0 }}, {{ $teachingMaster ?? 0 }}, 
                    {{ $teachingDegree ?? 0 }}, {{ $teachingHigherDiploma ?? 0 }}, {{ $teachingBTEC ?? 0 }}, 
                    {{ $teachingDiploma ?? 0 }}, {{ $teachingND ?? 0 }}, {{ $teachingCertificate ?? 0 }}, 
                    {{ $teachingOLevel ?? 0 }}, {{ $teachingALevel ?? 0 }}
                ]
            }],
            chart: { type: 'bar', height: 450 },
            plotOptions: {
                bar: { borderRadius: 4, horizontal: true, dataLabels: { position: 'top' } }
            },
            dataLabels: {
                enabled: true,
                offsetX: 30,
                style: { fontSize: '12px', colors: ['#dc2626'] }
            },
            xaxis: {
                categories: ['PhD', 'PGCE', 'Master', 'Degree', 'Higher Diploma', 'BTEC', 'Diploma', 'ND', 'Certificate', 'O Level', 'A Level']
            },
            colors: ['#dc2626'],
            grid: { borderColor: '#f1f1f1' }
        }).render();
        
        // Teaching Daerah Pie Chart
        new ApexCharts(document.querySelector("#teachingDaerahChart"), {
            series: [{{ $teachingBruneiMuara ?? 0 }}, {{ $teachingTutong ?? 0 }}, {{ $teachingKualaBelait ?? 0 }}, {{ $teachingTemburong ?? 0 }}],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: { show: true }
            },
            labels: ['Brunei Muara', 'Tutong', 'Kuala Belait', 'Temburong'],
            colors: ['#dc2626', '#f87171', '#fca5a5', '#fecaca'],
            legend: { position: 'bottom' },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex];
                }
            }
        }).render();
        
        // Non-Teaching Gender Pie Chart
        new ApexCharts(document.querySelector("#nonTeachingGenderPieChart"), {
            series: [{{ $nonTeachingLelaki }}, {{ $nonTeachingPerempuan }}],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: { show: true }
            },
            labels: ['Lelaki', 'Perempuan'],
            colors: ['#2563eb', '#60a5fa'],
            legend: { position: 'bottom' },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex];
                }
            }
        }).render();
        
        // Non-Teaching Kelulusan Bar Chart
        new ApexCharts(document.querySelector("#nonTeachingKelulusanChart"), {
            series: [{
                name: 'Staff Count',
                data: [
                    {{ $nonTeachingPhD ?? 0 }}, {{ $nonTeachingPGCE ?? 0 }}, {{ $nonTeachingMaster ?? 0 }}, 
                    {{ $nonTeachingDegree ?? 0 }}, {{ $nonTeachingHigherDiploma ?? 0 }}, {{ $nonTeachingBTEC ?? 0 }}, 
                    {{ $nonTeachingDiploma ?? 0 }}, {{ $nonTeachingND ?? 0 }}, {{ $nonTeachingCertificate ?? 0 }}, 
                    {{ $nonTeachingOLevel ?? 0 }}, {{ $nonTeachingALevel ?? 0 }}
                ]
            }],
            chart: { type: 'bar', height: 450 },
            plotOptions: {
                bar: { borderRadius: 4, horizontal: true, dataLabels: { position: 'top' } }
            },
            dataLabels: {
                enabled: true,
                offsetX: 30,
                style: { fontSize: '12px', colors: ['#2563eb'] }
            },
            xaxis: {
                categories: ['PhD', 'PGCE', 'Master', 'Degree', 'Higher Diploma', 'BTEC', 'Diploma', 'ND', 'Certificate', 'O Level', 'A Level']
            },
            colors: ['#2563eb'],
            grid: { borderColor: '#f1f1f1' }
        }).render();
        
        // Non-Teaching Daerah Pie Chart
        new ApexCharts(document.querySelector("#nonTeachingDaerahChart"), {
            series: [{{ $nonTeachingBruneiMuara ?? 0 }}, {{ $nonTeachingTutong ?? 0 }}, {{ $nonTeachingKualaBelait ?? 0 }}, {{ $nonTeachingTemburong ?? 0 }}],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: { show: true }
            },
            labels: ['Brunei Muara', 'Tutong', 'Kuala Belait', 'Temburong'],
            colors: ['#2563eb', '#60a5fa', '#93c5fd', '#dbeafe'],
            legend: { position: 'bottom' },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex];
                }
            }
        }).render();
        
        console.log('All charts rendered successfully');
    });
</script>

@endsection