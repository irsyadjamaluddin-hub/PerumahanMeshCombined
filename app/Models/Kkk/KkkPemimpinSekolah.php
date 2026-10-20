<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

class KkkPemimpinSekolah extends Model
{
    protected $table = 'kkk_pemimpin_sekolah';

    protected $fillable = ['sekolah_id', 'nama', 'jawatan', 'tarikh_lantikan', 'tarikh_tamat', 'semasa'];

    protected $casts = ['semasa' => 'boolean', 'tarikh_lantikan' => 'date', 'tarikh_tamat' => 'date'];

    public function sekolah()
    {
        return $this->belongsTo(KkkSekolah::class, 'sekolah_id');
    }
}
