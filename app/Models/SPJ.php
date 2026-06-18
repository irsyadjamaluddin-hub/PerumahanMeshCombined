<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    protected $table = 'spjs';

    public $timestamps = false;

    // ✅ CRITICAL ADDITIONS - These were missing!
    protected $primaryKey = 'id';      // ← ADD THIS
    public $incrementing = true;       // ← ADD THIS
    protected $keyType = 'int';        // ← ADD THIS

    protected $fillable = [
        'id',  // ✅ ADD 'id' to fillable so it can be retrieved and saved
        'nama',
        'noKadPintar',
        'kodSJ',  // ✅ ADD THIS - it's required for storeJawatanStaff
        'jantina',
        'tarikhLahir',
        'alamat',
        'namaBank',
        'noAkaunBukuBank',
        'tarikhBukuBankActive',
        'cawanganBank',
        'emelPeribadi',
        'emel',
        'noTelefon',
        'noMobile',
        'tap',
        'scp',
        'tarikhMulaBerkhidmat',
        'tarikhJawatanSekarang',  // ✅ ADD THIS - used in storeJawatanStaff
        'lainLainHal',  // ✅ ADD THIS - used for sekolah in storeJawatanStaff
        'jabatanTempatBertugas',  // ✅ ADD THIS - used in storeJawatanStaff
        'rujukanFile',
        'Text224',
        'Text236',
        'jenisTanggagaji',
        'tanggagajiSebenar',
        'Text228',
        'tarikhMinjamFail',
        'Text163',
        'Text167',  // ✅ ADD THIS - Jawatan Sekarang field
        'tarikhMulaiMemangku',
        'tempatBertugasSekarang',
        'Text171',
        'duaKertasKerjaProjek',
        // Kelulusan fields
        'kelulusanTertinggi',
        'sijilGuru',
        'sijilKerani',
        'kursusIPA',
        'GO',
        'FR',
        'Text170',  // Tempat Bertugas
        'Text172',  // Tarikh Diatur
        'Text169',  // Peruntukan
        'Text242',  // Jawatan
        'Combo251',  // Filter Bersara
        'peruntukanBersara',
        'jawatanBersara',
        'tarikhBersara',
        'tarikhCutiBersara',
        'tarikhTamatKontrak',
        'tatatertib',
        'lainLainHal2',  // Ulasan text
        'tarikhUlasan',  // Ulasan date
        'catatanTatatertib',
        // Jawatan Utama fields
        'Text260',      // summarize_bahagian1
        'mulaiActing',  // tarikhMulaiMemangku
        'teach',        // keputusanEDPMMO
        'gambar',       // Image field
    ];
    
    public function tempatBertugasRecords()
    {
        return $this->hasMany(TempatBertugas::class, 'spj_id');
    }
    
    public function ulasanBersaraRecords()
    {
        return $this->hasMany(UlasanBersara::class, 'spj_id', 'ID');
    }
}