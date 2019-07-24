<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRManagerRecommendationLog extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'mr_manager_recommendation_logs';

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
    public function managerRecommendation()
    {
        return $this->hasMany('App\MRManagerRecommendation', 'manager_rec_id');
    }

    // Model Function
    /**
     * Create a new log
     * 
     * @param int $id
     */
    public static function createNewLog($recID, $status)
    {
        MRManagerRecommendationLog::create([
            'manager_rec_id' => $recID,
            'status' => $status
        ]);
    }

    /**
     * Create a new log with status 0 = 'notified' 
     * 
     * @param int $id
     */
    public static function createNewNotifiedLog($recID)
    {
        self::createNewLog($recID, 0);
    }
    /**
     * Create a new log with status 1 = 'completed with recommended' 
     * 
     * @param int $id
     */
    public static function createNewCompleteRecommendedLog($recID)
    {
        self::createNewLog($recID, 1);
    }
    /**
     * Create a new log with status 0 = 'completed with not recommended' 
     * 
     * @param int $id
     */
    public static function createNewCompleteNotRecommendedLog($recID)
    {
        self::createNewLog($recID, 2);
    }
    
}
