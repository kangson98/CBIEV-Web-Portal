<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IRManagerRecommendation extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'ir_manager_recommendations';

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
     * Get
    */
    public function manager()
    {
        return $this->belongsTo('App\CBIEVStaff', 'recommended_by');
    }

    /**
     * 
     */
    public function statusTracking()
    {
        return $this->belongsTo('App\InvestorRegistrationStatusTracking', 'status_tracking_id');
    }

    /**
     * 
     */
    public function managerRecommendationLog()
    {
        return $this->hasMany('App\IRManagerRecommendationLog', 'manager_rec_id');
    }

    // Model Function
    /**
     * 
     */
    public static function createNewRecommendation($statusID, $managerID)
    {
        return IRManagerRecommendation::create([
            'recommended_by' => $managerID,
            'is_recommended' => null,
            'reason' => null,
            'comment' => null,
            'status_tracking_id' => $statusID,
        ]);         
    }

    /**
     * Update recommendation URL
     */
    public function updateURL($url)
    {
        $this->update([
            'url' => $url
        ]);
    }
}
