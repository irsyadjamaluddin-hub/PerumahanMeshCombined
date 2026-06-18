<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

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
                'news_file',
                'news_file_path',
                'news_title',
                'news_name',
                'news_date',
                'news_content',
                'created_at',
                'updated_at',
                ];

    protected $casts = [
        'news_file' => 'array',
        'news_file_path' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'news_date',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
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
