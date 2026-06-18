<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    
	use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
                  'name',
                  'email',
                  'ic_no',
                  'department_id',
                  'bahagian_id',
                  'division_id',
                  'telephone_mobile',                                    
				  'password',
				  'email_verified_at',
				  'remember_token',
				  'login_attempts',
				  'locked_until',
				  'ap1_name',
				  'ap1_email',
				  'ap1_name',
				  'ap2_email',
				  'approval_response',
				  'approve_at',
				  'approval_response2',
				  'approve_at2',







              ];


			  
	protected $hidden = [
        'password', 
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
	
	// public function roles(){
	// 	return $this->belongsToMany(related:'App\Role');
	// }
    

    /**
     * Set the email_verified_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailVerifiedAtAttribute($value)
    {
		$timestamp = now();
        $this->attributes['email_verified_at'] = $timestamp;
    }

    /**
     * Get email_verified_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEmailVerifiedAtAttribute($value)
    {
		if ($value == null) {
			echo ' ';
		} else {
			
        return date('j/n/Y g:i A', strtotime($value));
		}
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
	
	public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

	public function setRememberTokenAttribute($rememberToken)
    {
        $this->attributes['remember_token'] = Str::random(100);
    }

    
    // public function role(){
	// 	return $this->belongsToMany('App\Role');
	// }

    public function roles(){
		return $this->belongsToMany(related:'App\Role');
	}

}
