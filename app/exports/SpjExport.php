<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SpjExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $data;
    protected $jawatan;
    protected $jantina;
    protected $divisyen;
    protected $jenisTanggagaji;
    protected $tanggagajiSebenar;
    protected $cawanganDaerah;
    protected $kelulusan;
    protected $jabatan;
    protected $status;
    protected $umurMin;
    protected $umurMax;
    protected $tarikhBersaraFrom;

    public function __construct(
        $data, 
        $jawatan = null, 
        $jantina = null, 
        $divisyen = null,
        $jenisTanggagaji = null, 
        $tanggagajiSebenar = null, 
        $cawanganDaerah = null,
        $kelulusan = null, 
        $jabatan = null, 
        $status = null,
        $umurMin = null,
        $umurMax = null,
        $tarikhBersaraFrom = null
    ) {
        $this->data = $data;
        $this->jawatan = $jawatan;
        $this->jantina = $jantina;
        $this->divisyen = $divisyen;
        $this->jenisTanggagaji = $jenisTanggagaji;
        $this->tanggagajiSebenar = $tanggagajiSebenar;
        $this->cawanganDaerah = $cawanganDaerah;
        $this->kelulusan = $kelulusan;
        $this->jabatan = $jabatan;
        $this->status = $status;
        $this->umurMin = $umurMin;
        $this->umurMax = $umurMax;
        $this->tarikhBersaraFrom = $tarikhBersaraFrom;
    }

    private function shouldShowColumn($filterValue)
    {
        return $filterValue !== null && $filterValue !== '';
    }

    public function collection()
    {
        $rows = [];
        $rowNumber = 1;

        foreach ($this->data as $spj) {
            $row = [
                $rowNumber++,
                $spj->nama ?? '',
                $spj->noKadPintar ?? '',
                $spj->kodSJ ?? '',
                $spj->noMobile ?? '',
                $spj->noTelefon ?? '',
                $spj->emel ?? '',
            ];

            // Conditional columns based on filters
            if ($this->shouldShowColumn($this->jawatan)) {
                $row[] = $spj->jawatan_std ?? $spj->jawatan ?? '';
            }

            if ($this->shouldShowColumn($this->jantina)) {
                $row[] = $spj->jantina ?? '';
            }

            if ($this->shouldShowColumn($this->divisyen)) {
                $row[] = $spj->divisyen ?? '';
            }

            if ($this->shouldShowColumn($this->jenisTanggagaji)) {
                $row[] = $spj->jenisTanggagaji ?? '';
            }

            if ($this->shouldShowColumn($this->tanggagajiSebenar)) {
                $row[] = $spj->tanggagajiSebenar ?? '';
            }

            if ($this->shouldShowColumn($this->cawanganDaerah)) {
                $row[] = $spj->cawanganDaerah ?? '';
            }

            if ($this->shouldShowColumn($this->kelulusan)) {
                // ✅ FIXED: Show ORIGINAL kelulusan from database, not standardized
                // We use standardized for filtering, but display original in Excel
                $row[] = $spj->kelulusan ?? '';
            }

            if ($this->shouldShowColumn($this->jabatan)) {
                $row[] = $spj->jabatan ?? '';
            }

            // Show Umur column if umur filter is used
            if ($this->shouldShowColumn($this->umurMin) || $this->shouldShowColumn($this->umurMax)) {
                $row[] = $spj->umur ?? '';
            }

            // Show Tarikh Bersara column if tarikhBersara filter is used
            if ($this->shouldShowColumn($this->tarikhBersaraFrom)) {
                $row[] = $spj->tarikhBersara ?? '';
            }

            // Show Status column if status filter is used
            if ($this->shouldShowColumn($this->status)) {
                // Calculate status (same logic as in controller)
                $umur = $spj->umur ?? null;
                $tatatertib = $spj->tatatertib ?? 0;
                $tarikhBersara = $spj->tarikhBersara ?? null;
                
                $statusText = '';
                
                if ($umur !== null) {
                    // Check tatatertib first (highest priority)
                    if ($tatatertib == 1 && $tarikhBersara) {
                        try {
                            $bersaraDate = \Carbon\Carbon::parse($tarikhBersara);
                            $today = \Carbon\Carbon::now();
                            
                            if ($bersaraDate->isPast()) {
                                $statusText = 'Inactive (Tatatertib)';
                            } elseif ($umur >= 60) {
                                $statusText = 'Retired';
                            } else {
                                $statusText = 'Active';
                            }
                        } catch (\Exception $e) {
                            // If date parsing fails, fall back to age-based status
                            $statusText = $umur >= 60 ? 'Retired' : 'Active';
                        }
                    } else {
                        // No tatatertib, use age-based status
                        $statusText = $umur >= 60 ? 'Retired' : 'Active';
                    }
                }
                
                $row[] = $statusText;
            }

            $rows[] = $row;
        }

        return collect($rows);
    }

    public function headings(): array
    {
        $headings = [
            'No',
            'Nama',
            'No Kad Pintar',
            'Kod SJ',
            'No Mobile',
            'No Telefon',
            'Emel',
        ];

        if ($this->shouldShowColumn($this->jawatan)) {
            $headings[] = 'Jawatan';
        }

        if ($this->shouldShowColumn($this->jantina)) {
            $headings[] = 'Jantina';
        }

        if ($this->shouldShowColumn($this->divisyen)) {
            $headings[] = 'Divisyen';
        }

        if ($this->shouldShowColumn($this->jenisTanggagaji)) {
            $headings[] = 'Jenis Tanggagaji';
        }

        if ($this->shouldShowColumn($this->tanggagajiSebenar)) {
            $headings[] = 'Tanggagaji Sebenar';
        }

        if ($this->shouldShowColumn($this->cawanganDaerah)) {
            $headings[] = 'Cawangan/Daerah';
        }

        if ($this->shouldShowColumn($this->kelulusan)) {
            $headings[] = 'Kelulusan';
        }

        if ($this->shouldShowColumn($this->jabatan)) {
            $headings[] = 'Jabatan';
        }

        if ($this->shouldShowColumn($this->umurMin) || $this->shouldShowColumn($this->umurMax)) {
            $headings[] = 'Umur';
        }

        if ($this->shouldShowColumn($this->tarikhBersaraFrom)) {
            $headings[] = 'Tarikh Bersara';
        }

        if ($this->shouldShowColumn($this->status)) {
            $headings[] = 'Status';
        }

        return $headings;
    }

    public function columnWidths(): array
    {
        $widths = [
            'A' => 5,  // No
            'B' => 30, // Nama
            'C' => 20, // No Kad Pintar
            'D' => 15, // Kod SJ
            'E' => 15, // No Mobile
            'F' => 15, // No Telefon
            'G' => 25, // Emel
        ];

        $currentColumn = 'H';

        if ($this->shouldShowColumn($this->jawatan)) {
            $widths[$currentColumn] = 25;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->jantina)) {
            $widths[$currentColumn] = 10;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->divisyen)) {
            $widths[$currentColumn] = 10;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->jenisTanggagaji)) {
            $widths[$currentColumn] = 20;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->tanggagajiSebenar)) {
            $widths[$currentColumn] = 20;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->cawanganDaerah)) {
            $widths[$currentColumn] = 20;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->kelulusan)) {
            $widths[$currentColumn] = 30; // ✅ Increased width for original kelulusan text
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->jabatan)) {
            $widths[$currentColumn] = 25;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->umurMin) || $this->shouldShowColumn($this->umurMax)) {
            $widths[$currentColumn] = 10;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->tarikhBersaraFrom)) {
            $widths[$currentColumn] = 15;
            $currentColumn++;
        }

        if ($this->shouldShowColumn($this->status)) {
            $widths[$currentColumn] = 20;
            $currentColumn++;
        }

        return $widths;
    }

    public function styles(Worksheet $sheet)
    {
        // Count total columns
        $totalColumns = 7; // Base columns
        if ($this->shouldShowColumn($this->jawatan)) $totalColumns++;
        if ($this->shouldShowColumn($this->jantina)) $totalColumns++;
        if ($this->shouldShowColumn($this->divisyen)) $totalColumns++;
        if ($this->shouldShowColumn($this->jenisTanggagaji)) $totalColumns++;
        if ($this->shouldShowColumn($this->tanggagajiSebenar)) $totalColumns++;
        if ($this->shouldShowColumn($this->cawanganDaerah)) $totalColumns++;
        if ($this->shouldShowColumn($this->kelulusan)) $totalColumns++;
        if ($this->shouldShowColumn($this->jabatan)) $totalColumns++;
        if ($this->shouldShowColumn($this->umurMin) || $this->shouldShowColumn($this->umurMax)) $totalColumns++;
        if ($this->shouldShowColumn($this->tarikhBersaraFrom)) $totalColumns++;
        if ($this->shouldShowColumn($this->status)) $totalColumns++;

        $lastColumn = chr(64 + $totalColumns);

        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DBEAFE']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            "A2:{$lastColumn}1000" => [
                'alignment' => [
                    'wrapText' => true,
                ],
            ],
            'A:A' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}