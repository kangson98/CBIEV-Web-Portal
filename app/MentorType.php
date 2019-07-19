<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorType extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'mentor_types';

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

    /**
     * Get the type associate to the mentor registration
     * 
     */
    public function mentorType()
    {
        return $this-> belongsToMany('App\MentorType', 'mentor_regis_mentor_type', 'mentor_type_id', 'mentor_regis_id')->withTimestamps();;
    }

    // Model Function
}
