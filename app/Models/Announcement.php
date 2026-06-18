<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $connection = 'mysql';
    protected $table = 'announcement';

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
                'announcement_title',
                'announcement_date',
                'announcement_icon',
                'announcement_content',
                'anouncement_file',
                'announcement_file_path',
                'pdf_file',
                'pdf_file_path'
                ];

    protected $casts = [
        'pdf_file' => 'array',
        'pdf_file_path' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    
    /**
     * Get the role for this model.
     */

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
   /** public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    */

}
