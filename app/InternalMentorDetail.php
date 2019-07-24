<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalMentorDetail extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'internal_mentor_details';

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
     * Get the Internal Mentor Details associate to the mentor registration
     * 
     */
    public function mentorRegistration()
    {
            return $this->belongsTo('App\MentorRegistration', 'mentor_registration_id');
    }
    /**
     * Get the Center/Faculty  associate to the internal mentor detail
     * 
     */
    public function centerFaculty()
    {
            return $this->belongsTo('App\CenterFaculty', 'center_faculty_id');
    }
    // Model Function

    public static function createNewInternalMentorDetail($mentor_regis_id , $center_faculty_id)
    {
        return InternalMentorDetail::create([
            'mentor_registration_id' => $mentor_regis_id,
            'center_faculty_id' => $center_faculty_id,
        ]);
    }
}
