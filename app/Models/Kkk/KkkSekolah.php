<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

class KkkSekolah extends Model
{
    protected $table = 'kkk_sekolah';

    protected $fillable = ['nama', 'kod', 'rujukan_fail', 'peringkat', 'kluster', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];

    public function pemimpin()
    {
        return $this->hasMany(KkkPemimpinSekolah::class, 'sekolah_id');
    }

    public function pemimpinSemasa()
    {
        return $this->hasOne(KkkPemimpinSekolah::class, 'sekolah_id')->where('semasa', true);
    }

    public function rekod()
    {
        return $this->hasMany(KkkRekod::class, 'sekolah_id');
    }
}
