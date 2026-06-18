<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PemegangJawatanTeach extends Model
{
    protected $table = 'pemegangjawatanteach';

    // Set primary key to Bil
    protected $primaryKey = 'Bil';
    
    // Disable auto-incrementing if Bil is not an auto-increment field
    public $incrementing = false;
    
    // Disable timestamps
    public $timestamps = false;

    // Allow mass assignment for all columns
    protected $guarded = [];

    // List all columns that exist in your database table
    protected $fillable = [
        'Bil',
        'Nama',
        'No Kad Pintar',
        'Jawatan di Sekolah',
        'Sekolah Tempat Bertugas',
        'Kod Tempat Bertugas',
        'No Telefon',
        'No Mobile',
        'Email',
        'Personal Email',
        'Jantina',
        'Daerah',
        'Kelulusan Tertnggi',
        'Alamat',
        'Tarikh Lahir',
        'Tarikh Tamat Kontrak',
        'Tarikh Mula Berkhidmat',
        'Tarikh Jawatan Sekarang',
        'Tarikh diatur bertugas sekarang',
        'tarikhpenetapan',
        'TarikhKenaikan',
        'Tarikh Gaji Bulan',
        'tarikh lulus',
        'Tarikh Cuti Bersara',
        'Tanggagaji Sebenar',
        'Gaji Sekarang',
        'Jenis Perkhidmatan',
        'Jabatan Tempat Bertugas',
        'Unit Tempat Bertugas',
        'Bahagian Tempat Bertugas',
        'Rujukan File',
        'Tarikh Minjam Fail',
        'Jenis Sekolah Tempat Bertugas',
        'Jawatan disekolah',
        'Kluster',
        'Ruj Memo SPA SPG',
        'Peruntukan Bersara',
        'Filter Bersara',
        'Jawatan Bersara',
        'Sijil Guru',
        'filterkelulusan',
        'Bidang',
        'Mengajar',
        'Kursus IPA',
        'Sijil Kerani',
        'Picture',
        'Acting',
        'Mulai_acting',
        'EDPMMO',
        'CEP',
        'Dua Kertas Kerja Projek',
        'KadarKenaikan',
        'Elaun Kurnia Khas',
        'Elaun Sara Hidup',
        'Tarikh hingga',
        'gaji_matrix',
        'tatatertib',
        'tarikhBersaraOverride',
        'catatan_tatatertib',
        'Catatan Tambahan'
        
        // Add any other columns from your database
    ];
     // ← ADD THIS SECTION
    protected $casts = [
        'gaji_matrix' => 'array', // Automatically cast JSON to array
    ];
    /**
     * Safely parse a date attribute with multiple format support
     * 
     * @param string|null $value
     * @return Carbon|null
     */
    protected function parseDateAttribute($value)
    {
        if (empty($value) || trim($value) === '') {
            return null;
        }
        
        // Clean the date string
        $dateString = trim($value);
        
        // Array of possible date formats
        $formats = [
            'Y-m-d',           // 2024-01-15
            'd-m-Y',           // 15-01-2024
            'd/m/Y',           // 15/01/2024
            'd-M-y',           // 15-Jan-24
            'd-M-Y',           // 15-Jan-2024
            'j-M-y',           // 5-Jan-24
            'j-M-Y',           // 5-Jan-2024
            'd M Y',           // 15 Jan 2024
            'Y/m/d',           // 2024/01/15
            'm-d-Y',           // 01-15-2024
            'm/d/Y',           // 01/15/2024
        ];
        
        foreach ($formats as $format) {
            try {
                $date = Carbon::createFromFormat($format, $dateString);
                
                // Verify the date is valid and matches the format
                if ($date && $date->format($format) === $dateString) {
                    return $date;
                }
            } catch (\Exception $e) {
                // Continue to next format
                continue;
            }
        }
        
        // Last resort: try Carbon's parse method
        try {
            return Carbon::parse($dateString);
        } catch (\Exception $e) {
            Log::warning("Unable to parse date in model: {$dateString}");
            return null;
        }
    }

    /**
     * Safely format a date attribute to Y-m-d
     * 
     * @param string|null $value
     * @return string
     */
    protected function formatDateAttribute($value)
    {
        $date = $this->parseDateAttribute($value);
        return $date ? $date->format('Y-m-d') : '';
    }

    /**
     * Get age from Tarikh Lahir
     * 
     * @return string|null
     */
    public function getAgeAttribute()
    {
        if (empty($this->attributes['Tarikh Lahir'])) {
            return null;
        }
        
        try {
            $tarikhLahir = $this->parseDateAttribute($this->attributes['Tarikh Lahir']);
            
            if ($tarikhLahir) {
                $now = Carbon::now();
                $diff = $tarikhLahir->diff($now);
                return $diff->y . ' Tahun ' . $diff->m . ' Bulan';
            }
        } catch (\Exception $e) {
            Log::warning("Could not calculate age: " . $e->getMessage());
        }
        
        return null;
    }

    /**
     * Get retirement date (60 years from birth)
     * 
     * @return string|null
     */
    public function getRetirementDateAttribute()
    {
        if (empty($this->attributes['Tarikh Lahir'])) {
            return null;
        }
        
        try {
            $tarikhLahir = $this->parseDateAttribute($this->attributes['Tarikh Lahir']);
            
            if ($tarikhLahir) {
                return $tarikhLahir->copy()->addYears(60)->format('Y-m-d');
            }
        } catch (\Exception $e) {
            Log::warning("Could not calculate retirement date: " . $e->getMessage());
        }
        
        return null;
    }

    /**
     * Scope to find by No Kad Pintar
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $noKadPintar
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByKadPintar($query, $noKadPintar)
    {
        return $query->where('No Kad Pintar', $noKadPintar);
    }

    /**
     * Get formatted phone number (combines No Telefon and No Mobile)
     * 
     * @return string|null
     */
    public function getPhoneAttribute()
    {
        $noTelefon = !empty($this->attributes['No Telefon']) ? trim($this->attributes['No Telefon']) : null;
        $noMobile = !empty($this->attributes['No Mobile']) ? trim($this->attributes['No Mobile']) : null;
        
        return $noTelefon ?: $noMobile;
    }

    /**
     * Get formatted email (combines Email and Personal Email)
     * 
     * @return string|null
     */
    public function getEmailAddressAttribute()
    {
        $email = !empty($this->attributes['Email']) ? trim($this->attributes['Email']) : null;
        $personalEmail = !empty($this->attributes['Personal Email']) ? trim($this->attributes['Personal Email']) : null;
        
        return $email ?: $personalEmail;
    }

    /**
     * Get standardized Jawatan (handles "Guru Besar" variations)
     * 
     * @return string|null
     */
    public function getStandardizedJawatanAttribute()
    {
        $jawatan = $this->attributes['Jawatan di Sekolah'] ?? null;
        
        if (empty($jawatan)) {
            return null;
        }
        
        if (stripos($jawatan, 'guru besar') !== false) {
            return 'Guru Besar';
        }
        
        return $jawatan;
    }
    /**
 * Relationship to Gaji Matrix
 */
public function gajiMatrixRecords()
{
    return $this->hasMany(GajiMatrix::class, 'no_kad_pintar', 'No Kad Pintar')
                ->orderBy('tahun', 'desc');
}
/**
 * Relationship to Cuti Records
 */
public function cutiRecords()
{
    return $this->hasMany(CutiTeach::class, 'no_kad_pintar', 'No Kad Pintar');

}
/**
 * Relationship to Penyambungan
 */
public function penyambunganRecords()
{
    return $this->hasMany(Penyambungan::class, 'no_kad_pintar', 'No Kad Pintar')
                ->orderBy('tarikh_mula', 'desc');
}
/**
 * Relationship to Tempat Bertugas
 */
public function tempatBertugasRecords()
{
    return $this->hasMany(TempatBertugasTeaching::class, 'no_kad_pintar', 'No Kad Pintar')
                ->orderBy('tarikh_mula', 'desc');
}

/**
 * Relationship to Kursus Records
 */
public function kursusRecords()
{
    return $this->hasMany(KursusTeach::class, 'no_kad_pintar', 'No Kad Pintar');
}

/**
 * Relationship to Sejarah Jawatan
 */
public function sejarahJawatanRecords()
{
    return $this->hasMany(SejarahJawatanTeaching::class, 'no_kad_pintar', 'No Kad Pintar')
                ->orderBy('tarikh_lantikan', 'desc');
}


}