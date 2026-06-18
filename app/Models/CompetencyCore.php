<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetencyCore extends Model
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
    protected $table = 'competencies_cores';

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
        'comp_id',
        'indv_icno',
        'sd_st_evd',
        'sd_st_rcl',
        'sd_st_icl',
        'sd_st_outcome',
        'sd_st_otj',
        'sd_st_sl',
        'sd_st_ft',
        'sd_ca_evd',
        'sd_ca_rcl',
        'sd_ca_icl',
        'sd_ca_outcome',
        'sd_ca_otj',
        'sd_ca_sl',
        'sd_ca_ft',
        'sd_po_evd',
        'sd_po_rcl',
        'sd_po_icl',
        'sd_po_outcome',
        'sd_po_otj',
        'sd_po_sl',
        'sd_po_ft',
        'pe_cc_evd',
        'pe_cc_rcl',
        'pe_cc_icl',
        'pe_cc_outcome',
        'pe_cc_otj',
        'pe_cc_st',
        'pe_cc_ft',
        'pe_lo_evd',
        'pe_lo_rcl',
        'pe_lo_icl',
        'pe_lo_outcome',
        'pe_lo_otj',
        'pe_lo_sl',
        'pe_lo_ft',
        'pe_tw_evd',
        'pe_tw_rcl',
        'pe_tw_icl',
        'pe_tw_outcome',
        'pe_tw_otj',
        'pe_tw_st',
        'pe_tw_ft',
        'pc_dps_evd',
        'pc_dps_rcl',
        'pc_dps_icl',
        'pc_dps_outcome',
        'pc_dps_otj',
        'pc_dps_st',
        'pc_dps_ft',
        'pc_df_evd',
        'pc_df_rcl',
        'pc_df_icl',
        'pc_df_outcome',
        'pc_df_otj',
        'pc_df_st',
        'pc_df_ft',
        'pc_per_evd',
        'pc_per_rcl',
        'pc_per_icl',
        'pc_per_outcome',
        'pc_per_otj',
        'pc_per_st',
        'pc_per_ft',
        'oc_pmtd_evd',
        'oc_pmtd_rcl',
        'oc_pmtd_icl',
        'oc_pmtd_outcome',
        'oc_pmtd_otj',
        'oc_pmtd_st',
        'oc_pmtd_ft',
        'oc_cg_evd',
        'oc_cg_rcl',
        'oc_cg_icl',
        'oc_cg_outcome',
        'oc_cg_otj',
        'oc_cg_st',
        'oc_cg_ft',
        'oc_qdcf_evd',
        'oc_qdcf_rcl',
        'oc_qdcf_icl',
        'oc_qdcf_outcome',
        'oc_qdcf_otj',
        'oc_qdcf_st',
        'oc_qdcf_ft',
        'created_by_icno',
        'created_at',
        'updated_at'


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

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }
}
