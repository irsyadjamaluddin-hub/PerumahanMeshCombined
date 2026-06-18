<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MoeeventExportRatingList2 implements FromCollection, WithHeadings
{
    protected $data;
    protected $questions;

    public function __construct($data, $questions)
    {
        $this->data = $data;
        $this->questions = $questions;
    }

    public function headings(): array
    {
        $headings = ['Jabatan'];
        
        // Adding question and rating headings dynamically
        foreach ($this->questions as $index => $question) {
            $headings[] = "Question " . ($index + 1);
            $headings[] = "Rating " . ($index + 1);
        }
        
        $headings[] = 'Feedback';
        
        return $headings;
    }

    public function collection()
    {
        $formattedData = [];
        
        foreach ($this->data as $row) {
            $formattedRow = [
                $row->jabatan,
            ];
            
            // Adding ratings for each question dynamically
            foreach ($this->questions as $index => $question) {
                $formattedRow[] = $question;
                $formattedRow[] = $row->{'rating'.($index+1)};
            }
            
            $formattedRow[] = $row->feedback;
            $formattedData[] = $formattedRow;
        }
        
        return collect($formattedData);
    }
}
