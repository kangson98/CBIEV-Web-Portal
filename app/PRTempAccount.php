<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PRTempAccount extends Authenticatable
{
    /* The table associated with the model.
    *
    * @var string
    */
    protected $table = 'pr_temp_accounts';

    protected $guard = 'project-registration';

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
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'password' 
    ];
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

    // Model Relation Function
    /**
     * 
     */
    public function projectRegistration()
    {
        return $this->belongsTo('App\ProjectRegistration', 'project_registration_id');
    }

    //

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
}
