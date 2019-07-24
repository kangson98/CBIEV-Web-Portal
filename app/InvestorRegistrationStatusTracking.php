<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestorRegistrationStatusTracking extends Model
{
/**
     * Table name for this model
     */
    protected $table = 'ir_status_trackings';

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
    public function investorRegistration()
    {
        return $this-> belongsTo('App\InvestorRegistration', 'investor_regis_id');
    }
    /**
     * 
     */
    public function managerRecommendation()
    {
        return $this-> hasMany('App\IRManagerRecommendation', 'status_tracking_id');
    }
    /**
     * 
     */
    public function directorApproval()
    {
        return $this-> hasMany('App\IRDirectorApproval', 'status_tracking_id');
    }

    // Model Function
    /**
     * Create new status for mentor registration
     */
    public static function createNewStatus($investorRegisID, $status)
    {
        InvestorRegistrationStatusTracking::create([
            'investor_regis_id' => $investorRegisID,
            'investor_registration_status' => $status
        ]);
    }

    /**
     * 
     */
    public static function newRegisteredStatus($investorRegisID)
    {
        self::createNewStatus($investorRegisID, 0);
    }
}
