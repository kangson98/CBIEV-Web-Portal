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
        return $this-> hasOne('App\IRManagerRecommendation', 'status_tracking_id');
    }
    /**
     * 
     */
    public function directorApproval()
    {
        return $this-> hasOne('App\IRDirectorApproval', 'status_tracking_id');
    }

    // Model Function
    /**
     * Create new status for mentor registration
     */
    public static function createNewStatus($investorRegisID, $status)
    {
        return InvestorRegistrationStatusTracking::create([
            'investor_regis_id' => $investorRegisID,
            'investor_registration_status' => $status
        ]);
    }

    /**
     * 
     */
    public static function newRegisteredStatus($investorRegisID)
    {
        return self::createNewStatus($investorRegisID, 0);
    }

    /**
     * 
     */
    public static function newManagerRecommendationStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 1);
    }

    /**
     * 
     */
    public static function newDirectorApprovalStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 2);
    }

    /**
     * Create new mentor status with terminated
     */
    public static function newTerminatedStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 3);
    }
}
