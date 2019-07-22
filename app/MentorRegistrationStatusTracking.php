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
        return $this-> hasMany('App\MRManagerRecommendation', 'status_tracking_id');
    }
    /**
     * 
     */
    public function directorApproval()
    {
        return $this-> hasMany('App\MRdirectorApproval', 'status_tracking_id');
    }
    /**
     * 
     */
    public function deanHeadRecommendation()
    {
        return $this-> hasMany('App\MRDeanHeadRecommendation', 'status_tracking_id');
    }
}
