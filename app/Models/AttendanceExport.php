<?php

namespace App\Models;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceExport extends Model implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Name',
            'IC.No',
            'Birth Cert',
            'Year',
            'Classroom Name',
            'School',
            'District',
    		'Attend',
            'Attend By',
            'Attend Time',
            'Event',
            'Created At'

            
        ];
    }

    public function collection()
    {
        return collect($this->data);
    }
}
