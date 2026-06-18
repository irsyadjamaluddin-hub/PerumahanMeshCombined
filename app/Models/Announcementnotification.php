<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcementnotification extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $connection = 'mysql';
    protected $table = 'announcementnotification';

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
                'ic_no',
                'email',
                'notification'
                ];

    protected $casts = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

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
