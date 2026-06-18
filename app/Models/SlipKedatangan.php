<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipKedatangan extends Model
{
   /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'slipkedatangan';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'id',
                  'perkara',
                  'jabatan',
                  'nama',
                  'rolelabel',
                  'jawatan',
                  'email',
                  'telefon',
                  'remark',
                'created_at',
                's_k_perkara_id'

              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function departments()
    {
        return $this->belongsTo('app\Models\Department', 'department_id');
    }

    public function skperkara() {
      return $this->belongsTo(SKPerkara::class);
    }
}
