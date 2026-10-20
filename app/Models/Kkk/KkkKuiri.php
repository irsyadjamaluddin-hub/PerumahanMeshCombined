<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

class KkkKuiri extends Model
{
    protected $table = 'kkk_kuiri';

    protected $fillable = ['rekod_id', 'pusingan', 'tarikh_dihadapkan', 'tarikh_jawapan', 'keterangan'];

    protected $casts = ['tarikh_dihadapkan' => 'date', 'tarikh_jawapan' => 'date'];

    public function rekod()
    {
        return $this->belongsTo(KkkRekod::class, 'rekod_id');
    }
}
