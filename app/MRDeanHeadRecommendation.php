<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRDeanHeadRecommendation extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'mr_dean_head_recommendations';

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
    public function deanHead()
    {
        return $this->belongsTo('App\DeanHead', 'recommended_by');
    }

    /**
     * 
     */
    public function statusTracking()
    {
        return $this->belongsTo('App\MentorRegistrationStatusTracking', 'status_tracking_id');
    }

    /**
     * 
     */
    public function deanHeadRecommendationLog()
    {
        return $this->hasMany('App\MRDeanHeadRecommendationLog', 'dean_head_rec_id');
    }

    /**
     * 
     */
    public static function createNewDeanHeadRecommendation($statusTracking, $recommendedBy)
    {
        return MRDeanHeadRecommendation::create([
            'recommended_by' => $recommendedBy,
            'status_tracking_id' => $statusTracking
        ]);
    }
}
