<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorRegistrationStatusTracking extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'mr_status_trackings';

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
    public function mentorRegistration()
    {
        return $this-> belongsTo('App\MentorRegistration', 'mentor_regis_id');
    }
    /**
     * 
     */
    public function managerRecommendation()
    {
        return $this-> hasOne('App\MRManagerRecommendation', 'status_tracking_id');
    }
    /**
     * 
     */
    public function directorApproval()
    {
        return $this-> hasOne('App\MRdirectorApproval', 'status_tracking_id');
    }
    /**
     * 
     */
    public function deanHeadRecommendation()
    {
        return $this-> hasOne('App\MRDeanHeadRecommendation', 'status_tracking_id');
    }

    // Model Function
    /**
     * Create new status for mentor registration
     */
    public static function createNewStatus($mentorRegisID, $status)
    {
        return MentorRegistrationStatusTracking::create([
            'mentor_regis_id' => $mentorRegisID,
            'mentor_registration_status' => $status
        ]);
    }

    /**
     * 
     */
    public static function newRegisteredStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 0);
    }

    /**
     * 
     */
    public static function newDeanHeadRecommendationStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 1);
    }

    /**
     * 
     */
    public static function newManagerRecommendationStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 2);
    }

    /**
     * 
     */
    public static function newDirectorApprovalStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 3);
    }

    /**
     * Create new mentor status with terminated
     */
    public static function newTerminatedStatus($mentorRegisID)
    {
        return self::createNewStatus($mentorRegisID, 4);
    }


}
