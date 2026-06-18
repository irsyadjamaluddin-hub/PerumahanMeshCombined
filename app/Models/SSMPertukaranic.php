<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMPertukaranic extends Model
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
    protected $table = 'ssm_pertukaranic';

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
        'pi_name',
        'pi_icno_old',
        'pi_fileold',
        'pi_icno_new',
        'pi_filenew',
        'pi_jawatan',
        'pi_workplace',
        'pi_email',
        'pi_notel',
        'pi_catatanuser',
        'pi_catatanadmin',
        'pi_status',
        'pi_created_at',
        'pi_updated_at',
        'pi_updated_by',
        'pi_diterima_at',
        'pi_diterima_by',
        'pi_hd_at',
        'pi_hd_by',
        'pi_selesai_at',
        'pi_selesai_by',
        'pi_otp',

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
    protected $casts = [
        'pi_fileold' => 'array',
        'pi_filenew' => 'array',
    ];



}
