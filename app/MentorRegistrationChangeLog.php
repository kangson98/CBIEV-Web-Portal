<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorRegistrationChangeLog extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'mentor_registration_change_logs';

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


    // Model Function
    /**
     * Create and return new instance of model 
     */
    public static function createNewLog($mrID, $column, $newValue, $oldValue)
    {
        return MentorRegistrationChangeLog::create([
            'mentor_registration_id' => $mrID,
            'column_name' => $column,
            'new_value' => $newValue,
            'old_value' => $oldValue,
        ]);
    } 
}
