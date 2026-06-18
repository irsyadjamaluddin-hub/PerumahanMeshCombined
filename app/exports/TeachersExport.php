<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Illuminate\Support\Facades\Log;

class TeachersExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $teachers;
    protected $jawatan;
    protected $jantina;
    protected $tempatBertugas;
    protected $daerah;
    protected $kelulusan;
    protected $status;
    
    public function __construct($teachers, $jawatan = null, $jantina = null, $tempatBertugas = null, $daerah = null, $kelulusan = null, $status = null)
    {
        $this->teachers = $teachers;
        $this->jawatan = $jawatan;
        $this->jantina = $jantina;
        $this->tempatBertugas = $tempatBertugas;
        $this->daerah = $daerah;
        $this->kelulusan = $kelulusan;
        $this->status = $status;
        
        // DEBUG LOG
        Log::info('=== TEACHERS EXPORT CONSTRUCTOR ===', [
            'jawatan' => $jawatan,
            'jantina' => $jantina,
            'tempatBertugas' => $tempatBertugas,
            'daerah' => $daerah,
            'kelulusan' => $kelulusan,
            'status' => $status,
            'shouldShowJawatan' => $this->shouldShowColumn($jawatan),
            'shouldShowJantina' => $this->shouldShowColumn($jantina),
            'shouldShowTempatBertugas' => $this->shouldShowColumn($tempatBertugas),
            'shouldShowDaerah' => $this->shouldShowColumn($daerah),
            'shouldShowKelulusan' => $this->shouldShowColumn($kelulusan),
            'shouldShowStatus' => $this->shouldShowColumn($status),
        ]);
    }

    /**
     * Check if column should be shown
     * Show column if filter is applied (not null and not empty string)
     */
    private function shouldShowColumn($filterValue)
    {
        $result = $filterValue !== null && $filterValue !== '';
        Log::info('shouldShowColumn check:', [
            'value' => $filterValue,
            'is_null' => is_null($filterValue),
            'is_empty_string' => $filterValue === '',
            'result' => $result
        ]);
        return $result;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->teachers->map(function ($teacher, $index) {
            $row = [
                'No' => $index + 1,
                'Nama' => $teacher->Nama ?? '',
                'No Kad Pintar' => $teacher->noKadPintar ?? '',
                'No Telefon' => $teacher->noTelefon ?? '',
                'Email' => $teacher->email ?? '',
            ];
            
            // Include Jawatan column if filter is applied (including "all")
            if ($this->shouldShowColumn($this->jawatan)) {
                $row['Jawatan'] = $teacher->jawatan ?? '';
            }
            
            // Include Jantina column if filter is applied (including "all")
            if ($this->shouldShowColumn($this->jantina)) {
                $row['Jantina'] = $teacher->jantina ?? '';
            }
            
            // Include Tempat Bertugas column if filter is applied (including "all")
            if ($this->shouldShowColumn($this->tempatBertugas)) {
                $row['Tempat Bertugas'] = $teacher->tempatBertugas ?? '';
            }
            
            // Include Daerah column if filter is applied (including "all")
            if ($this->shouldShowColumn($this->daerah)) {
                $row['Daerah'] = $teacher->daerah ?? '';
            }
            
            // Include Kelulusan column if filter is applied (including "all")
            if ($this->shouldShowColumn($this->kelulusan)) {
                $row['Kelulusan'] = $teacher->kelulusan ?? '';
            }
            
            // Include Status column if filter is applied (including "all")
            if ($this->shouldShowColumn($this->status)) {
                // Calculate status
                $tatatertib = $teacher->tatatertib;
                $overrideDate = $teacher->tarikhBersaraOverride;
                $umur = $teacher->umur;
                
                $statusText = 'Unknown';
                
                if ($umur !== null) {
                    // Check tatatertib override first
                    if ($tatatertib == 1 && $overrideDate) {
                        $override = new \DateTime($overrideDate);
                        $today = new \DateTime();
                        $today->setTime(0, 0, 0);
                        $override->setTime(0, 0, 0);
                        
                        if ($override <= $today) {
                            $statusText = 'Inactive (tatatertib)';
                        } else {
                            $statusText = $umur >= 60 ? 'Retired' : 'Active';
                        }
                    } else {
                        $statusText = $umur >= 60 ? 'Retired' : 'Active';
                    }
                }
                
                $row['Status'] = $statusText;
            }
            
            return $row;
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $headings = [
            'No',
            'Nama',
            'No Kad Pintar',
            'No Telefon',
            'Email'
        ];
        
        // Include columns based on filters
        if ($this->shouldShowColumn($this->jawatan)) {
            $headings[] = 'Jawatan';
        }
        
        if ($this->shouldShowColumn($this->jantina)) {
            $headings[] = 'Jantina';
        }
        
        if ($this->shouldShowColumn($this->tempatBertugas)) {
            $headings[] = 'Tempat Bertugas';
        }
        
        if ($this->shouldShowColumn($this->daerah)) {
            $headings[] = 'Daerah';
        }
        
        if ($this->shouldShowColumn($this->kelulusan)) {
            $headings[] = 'Kelulusan';
        }
        
        if ($this->shouldShowColumn($this->status)) {
            $headings[] = 'Status';
        }
        
        Log::info('=== FINAL HEADINGS ===', ['headings' => $headings]);
        
        return $headings;
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        $widths = [
            'A' => 5,   // No
            'B' => 25,  // Nama
            'C' => 15,  // No Kad Pintar
            'D' => 15,  // No Telefon
            'E' => 30,  // Email
        ];
        
        $currentColumn = 'F';
        
        // Dynamically assign column widths based on included columns
        if ($this->shouldShowColumn($this->jawatan)) {
            $widths[$currentColumn] = 20; // Jawatan
            $currentColumn++;
        }
        
        if ($this->shouldShowColumn($this->jantina)) {
            $widths[$currentColumn] = 10; // Jantina
            $currentColumn++;
        }
        
        if ($this->shouldShowColumn($this->tempatBertugas)) {
            $widths[$currentColumn] = 30; // Tempat Bertugas
            $currentColumn++;
        }
        
        if ($this->shouldShowColumn($this->daerah)) {
            $widths[$currentColumn] = 15; // Daerah
            $currentColumn++;
        }
        
        if ($this->shouldShowColumn($this->kelulusan)) {
            $widths[$currentColumn] = 25; // Kelulusan
            $currentColumn++;
        }
        
        if ($this->shouldShowColumn($this->status)) {
            $widths[$currentColumn] = 20; // Status
        }
        
        return $widths;
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->teachers->count() + 1;
        
        // Count total columns
        $totalColumns = 5; // Base columns (No, Nama, No Kad Pintar, No Telefon, Email)
        if ($this->shouldShowColumn($this->jawatan)) $totalColumns++;
        if ($this->shouldShowColumn($this->jantina)) $totalColumns++;
        if ($this->shouldShowColumn($this->tempatBertugas)) $totalColumns++;
        if ($this->shouldShowColumn($this->daerah)) $totalColumns++;
        if ($this->shouldShowColumn($this->kelulusan)) $totalColumns++;
        if ($this->shouldShowColumn($this->status)) $totalColumns++;
        
        $lastColumn = chr(64 + $totalColumns); // Convert number to letter (A=65, so we use 64+number)

        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'E2E8F0']
                ]
            ],
            // All data alignment
            'A2:' . $lastColumn . $lastRow => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
            // Center align No column
            'A2:A' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}