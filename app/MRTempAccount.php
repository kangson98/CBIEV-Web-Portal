<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MRTempAccount extends Authenticatable
{
    /**
     * Guard for this model
     */
    protected $guard = 'mentor-registration';
    
    /**
     * Table name for this model
     */
    protected $table = 'mr_temp_accounts';

    /**
    * The primary key associated with the model.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    // Model Relationship Function
    /**
     * Get the mentor registration that own this account
     * 
     */
    public function mentorRegistration()
    {
        return $this->belongsTo('App\MentorRegistration', 'mentor_registration_id');
    }

    // Model Function

    /**
     * Activate the project registration temporary account 
     */
    public function activate($status = true)
    {
        $this-> update([
            'is_activate' => $status
        ]);
    }
    /**
     * Deactivate the project registration temporary account
     */
    public function deactivate()
    {
        $this-> activate(false);
    }

    /**
     * Create new temp account
     */
    public static function createNewTempAccount($registrantID, $registrantIC)
    {
        return MRTempAccount::create([
                [
                    'mentor_registration_id' => $registrantID,
                    'login_id' => 'M000' . $registrantID,
                    'password' => Hash::make($registrantIC)
                ]
        ]);
    }
}
