<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRegistrationStatusTracking extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'pr_status_trackings';

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

    // Model Relation Function
    /**
     * 
     */
    public function supervisorRecommendation()
    {
        return $this->hasMany('App\PRSupervisorRecommendation','pr_status_tracking_id');
    }
    /**
     * 
     */
    public function deanHeadRecommendation()
    {
        return $this->hasMany('App\PRDeanHeadRecommendation','pr_status_tracking_id');
    }
    /**
     * 
     */
    public function managerRecommendation()
    {
        return $this->hasMany('App\PRManagerRecommendation','pr_status_tracking_id');
    }
    /**
     * 
     */
    public function directorApproval()
    {
        return $this->hasMany('App\PRDirectorApproval','pr_status_tracking_id');
    }
    /**
     * 
     */
    public function projectRegistration()
    {
        return $this->belongsTo('App\ProjectRegistration', 'project_registration_id');
    }
}
