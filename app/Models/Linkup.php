<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Linkup extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'linkup';

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

                'created_at',
                'updated_at',
                ];

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

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
