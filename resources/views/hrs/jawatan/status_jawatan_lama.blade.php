@extends('hrs.layouts.landing')

@section('content')

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- jsPDF and html2canvas for PDF generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<div class="container-fluid" style="background-color: #f5f5f5; min-height: 100vh; padding: 20px;">
    <div class="row">
        <div class="col-12">
            
            <!-- Enhanced Header Section with Navigation -->
            <div class="no-print" style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <!-- Title and Buttons Row -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0;">
                    <div>
                        <h3 style="margin-bottom: 8px; color: #2c3e50; font-weight: 600;">
                            <i class="bi bi-file-earmark-text-fill" style="color: #3498db;"></i>
                            Status Jawatan - Lama
                        </h3>
                        <p style="margin: 0; color: #7f8c8d; font-size: 0.95rem;">
                            <i class="bi bi-briefcase-fill"></i> Jawatan: <strong style="color: #2c3e50;">{{ $jawatan }}</strong>
                        </p>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button onclick="window.print()" class="btn btn-primary" style="background-color: #3498db; border-color: #3498db; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s ease;">
                            <i class="bi bi-printer-fill"></i> Print
                        </button>
                        <button onclick="saveToPDF()" class="btn btn-success" style="background-color: #27ae60; border-color: #27ae60; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s ease;">
                            <i class="bi bi-download"></i> Download PDF
                        </button>
                        <a href="{{ route('pj.nonteaching.jawatan') }}" class="btn btn-secondary" style="background-color: #95a5a6; border-color: #95a5a6; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s ease;">
                            <i class="bi bi-x-circle-fill"></i> Close
                        </a>
                    </div>
                </div>
                
                <!-- Smooth Navigation Row -->
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 12px; background: #f8f9fa; padding: 15px 25px; border-radius: 50px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);">
                        <span style="font-weight: 600; color: #6c757d; margin-right: 5px; font-size: 0.9rem;">
                            <i class="bi bi-journals"></i> Page
                        </span>
                        
                        <a href="{{ route('pj.nonteaching.jawatan.status.lama', ['jawatan' => $jawatan, 'record' => 'first']) }}" 
                           class="nav-btn {{ $currentPosition <= 1 ? 'disabled' : '' }}"
                           title="First Page"
                           style="background: white; border: none; width: 36px; height: 36px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #6c757d; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.08); {{ $currentPosition <= 1 ? 'opacity: 0.4; pointer-events: none;' : '' }}">
                            <i class="bi bi-chevron-bar-left"></i>
                        </a>
                        
                        <a href="{{ route('pj.nonteaching.jawatan.status.lama', ['jawatan' => $jawatan, 'record' => 'prev', 'current' => $currentPosition]) }}" 
                           class="nav-btn {{ $currentPosition <= 1 ? 'disabled' : '' }}"
                           title="Previous"
                           style="background: white; border: none; width: 36px; height: 36px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #6c757d; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.08); {{ $currentPosition <= 1 ? 'opacity: 0.4; pointer-events: none;' : '' }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        
                        <span style="margin: 0 15px; font-weight: 600; font-size: 1rem; color: #2c3e50; min-width: 100px; text-align: center;">
                            <strong style="color: #3498db; font-size: 1.1rem;">{{ $currentPosition }}</strong> 
                            <span style="color: #95a5a6; font-weight: 400;">of</span> 
                            <strong style="color: #2c3e50;">{{ $totalRecords }}</strong>
                        </span>
                        
                        <a href="{{ route('pj.nonteaching.jawatan.status.lama', ['jawatan' => $jawatan, 'record' => 'next', 'current' => $currentPosition]) }}" 
                           class="nav-btn {{ $currentPosition >= $totalRecords ? 'disabled' : '' }}"
                           title="Next"
                           style="background: white; border: none; width: 36px; height: 36px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #6c757d; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.08); {{ $currentPosition >= $totalRecords ? 'opacity: 0.4; pointer-events: none;' : '' }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        
                        <a href="{{ route('pj.nonteaching.jawatan.status.lama', ['jawatan' => $jawatan, 'record' => 'last']) }}" 
                           class="nav-btn {{ $currentPosition >= $totalRecords ? 'disabled' : '' }}"
                           title="Last Page"
                           style="background: white; border: none; width: 36px; height: 36px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #6c757d; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.08); {{ $currentPosition >= $totalRecords ? 'opacity: 0.4; pointer-events: none;' : '' }}">
                            <i class="bi bi-chevron-bar-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Print Preview Page -->
            <div class="print-page" style="width: 210mm; min-height: 297mm; margin: 0 auto; background: white; padding: 20mm; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; border-radius: 8px;">
                
                <!-- Header -->
                <div style="text-align: right; margin-bottom: 20px;">
                    <strong>KOSONG</strong>
                </div>

                <!-- Title -->
                <div style="border: 2px solid black; padding: 10px; text-align: center; margin-bottom: 20px;">
                    <div style="font-weight: bold;">BORANG PENGESAHAN BILANGAN KEKOSONGAN</div>
                    <div style="font-weight: bold;">UNIT KEANGGOTAAN DAN PENGIKLANAN, BAHAGIAN PERJAWATAN</div>
                    <div style="font-weight: bold;">JABATAN PENTADBIRAN DAN PERKHIDMATAN-PERKHIDMATAN, KEMENTERIAN PENDIDIKAN</div>
                </div>

                <!-- Jawatan Info Table -->
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <tr>
                        <td style="border: 1px solid black; padding: 8px; width: 30%; font-weight: bold; vertical-align: top;">
                            NAMA JAWATAN<br>
                            <span style="font-weight: normal; font-size: 0.85em;">[menurut dalam Buku Anggaran Hasil dan Perbelanjaan Negara]</span>
                        </td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $record->Jawatan ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px; font-weight: bold; vertical-align: top;">
                            TANGGAGAJI<br>
                            <span style="font-weight: normal; font-size: 0.85em;">[menurut dalam Buku Anggaran Hasil dan Perbelanjaan Negara]</span>
                        </td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $record->Tanggagaji ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px; font-weight: bold;">KEMENTERIAN/ JABATAN/ BAHAGIAN:</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $record->Text183 ?? '' }}</td>
                    </tr>
                </table>

                <!-- Bilangan Jawatan Table -->
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <tr style="background-color: #f0f0f0;">
                        <td style="border: 1px solid black; padding: 8px; font-weight: bold;">JUMLAH BILANGAN JAWATAN</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold;">PERUNTUKAN</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold;">KOSONG</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold;">DIPENUHI</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;"></td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $record->Peruntukan_Baru ?? 0 }}</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $record->Kosong ?? 0 }}</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $record->Penuh ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border: 1px solid black; padding: 8px; font-weight: bold;">STATUS JAWATAN :-</td>
                    </tr>
                </table>

                <!-- Notes Section -->
                <div style="margin-top: 40px; border-top: 2px solid black; padding-top: 20px;">
                    <p style="margin: 0; font-size: 0.9em;">KEKOSONGAN DISEBABKAN:</p>
                    @if($record->Peniadaan)
                        <p style="margin: 5px 0;">{{ $record->Peniadaan }}</p>
                    @else
                        <p style="margin: 5px 0; color: #999;">-</p>
                    @endif
                </div>

                <!-- Footer Section -->
                <div style="margin-top: 60px; padding-top: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.95em;">
                        <div style="flex: 1;">
                            <strong>DISAHKAN OLEH:</strong> [...................................................................................................]
                        </div>
                        <div style="text-align: right;">
                            <strong>Tarikh:</strong> {{ date('d-M-y') }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
// Save to PDF function - generates PDF and triggers browser's Save As dialog
async function saveToPDF() {
    // Get the button that was clicked
    const button = event.target.closest('button');
    
    // Get the print page element
    const element = document.querySelector('.print-page');
    
    // Show loading indicator
    const originalButtonHTML = button.innerHTML;
    button.innerHTML = '<i class="bi bi-hourglass-split"></i> Generating PDF...';
    button.disabled = true;
    
    try {
        // Generate canvas from HTML
        const canvas = await html2canvas(element, {
            scale: 2,
            useCORS: true,
            logging: false,
            backgroundColor: '#ffffff'
        });
        
        // Get canvas dimensions
        const imgWidth = 210; // A4 width in mm
        const pageHeight = 297; // A4 height in mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        
        // Create PDF
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');
        
        // Add image to PDF
        const imgData = canvas.toDataURL('image/png');
        pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
        
        // Generate filename
        const filename = 'Status_Jawatan_Lama_{{ $jawatan }}_Page_{{ $currentPosition }}.pdf';
        
        // Save PDF - this triggers browser's Save As dialog
        pdf.save(filename);
        
        // Restore button immediately after save is triggered
        button.innerHTML = originalButtonHTML;
        button.disabled = false;
        
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Error generating PDF. Please try again or use the Print button.');
        
        // Restore button on error
        button.innerHTML = originalButtonHTML;
        button.disabled = false;
    }
}
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    /* Remove all margins and padding from body */
    body {
        margin: 0 !important;
        padding: 0 !important;
        background: white !important;
    }
    
    /* Print page takes full page */
    .print-page {
        box-shadow: none !important;
        margin: 0 !important;
        padding: 15mm 15mm 15mm 15mm !important; /* Reduced padding to fit better */
        border-radius: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        page-break-after: avoid !important;
    }
    
    /* Ensure tables fit properly */
    table {
        width: 100% !important;
        page-break-inside: avoid !important;
    }
    
    /* Prevent page breaks inside table rows */
    tr {
        page-break-inside: avoid !important;
    }
    
    /* Set proper page size */
    @page {
        size: A4 portrait;
        margin: 0mm; /* Let .print-page handle margins */
    }
    
    /* Ensure all content stays within page */
    * {
        box-sizing: border-box !important;
    }
    
    /* Scale down if needed to fit */
    html {
        zoom: 0.95; /* Slight zoom out to ensure everything fits */
    }
}

@media screen {
    body {
        background-color: #f5f5f5;
    }
}

/* Smooth Button Hover Effects */
.btn-primary:hover {
    background-color: #2980b9 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4) !important;
}

.btn-success:hover {
    background-color: #229954 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4) !important;
}

.btn-secondary:hover {
    background-color: #7f8c8d !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(149, 165, 166, 0.4) !important;
}

/* Smooth Navigation Button Hover */
.nav-btn:hover:not(.disabled) {
    background-color: #3498db !important;
    color: white !important;
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3) !important;
}

/* Print page styling */
.print-page {
    transition: box-shadow 0.3s ease;
}

.print-page:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.12) !important;
}

.bi {
    vertical-align: middle;
}

/* Smooth transitions */
* {
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
}
</style>

@endsection