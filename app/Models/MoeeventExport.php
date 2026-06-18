<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MoeeventExport extends Model implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Jabatan',
            'Jawatan',
            'Nama',
            'IC.No',
            'Email',
            'Phone Number',
            'Gender',
            'Status',

		'attend'

            
        ];
    }

    public function collection()
    {
        return collect($this->data);
    }
}
