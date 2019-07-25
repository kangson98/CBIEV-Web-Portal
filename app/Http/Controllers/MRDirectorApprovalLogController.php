<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MRDirectorApprovalLogController extends Controller
{
        /**
     * Table name for this model
     */
    protected $table = 'mr_director_approval_logs';

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
    public function directorApproval()
    {
        return $this->hasMany('App\MRDirectorApproval', 'director_app_id');
    }

    // Model Function
    /**
     * Create a new log
     * 
     * @param int $id
     */
    public static function createNewLog($appID, $status)
    {
        MRManagerRecommendationLog::create([
            'director_app_id' => $appID,
            'status' => $status
        ]);
    }

    /**
     * Create a new log with status 0 = 'notified' 
     * 
     * @param int $id
     */
    public static function createNewNotifiedLog($appID)
    {
        self::createNewLog($appID, 0);
    }
    /**
     * Create a new log with status 1 = 'completed with approved' 
     * 
     * @param int $id
     */
    public static function createNewCompleteRecommendedLog($appID)
    {
        self::createNewLog($appID, 1);
    }
    /**
     * Create a new log with status 0 = 'completed with not approved' 
     * 
     * @param int $id
     */
    public static function createNewCompleteNotRecommendedLog($appID)
    {
        self::createNewLog($appID, 2);
    }
    /**
     * Create a new log with status 0 = 'completed with agree' 
     * 
     * @param int $id
     */
    public static function createNewCompleteAgreeLog($appID)
    {
        self::createNewLog($appID, 3);
    }
    /**
     * Create a new log with status 0 = 'completed with not agree' 
     * 
     * @param int $id
     */
    public static function createNewCompleteNotAgreeLog($appID)
    {
        self::createNewLog($appID, 4);
    }
}
