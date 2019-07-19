<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRManagerRecommendation extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'pr_manager_recommendations';
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
    public function manager()
    {
        return $this->belongsTo('App\CBIEVStaff', 'recommended_by');
    }

    /**
     * 
     */
    public function prStatus()
    {
        return $this->belongsTo('App\ProjectRegistrationStatusTracking', 'pr_status_tracking_id');
    }

}
