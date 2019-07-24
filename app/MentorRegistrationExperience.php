<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorRegistrationExperience extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'mentor_registration_experiences';

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
     * Get the mentor registration that own the experience
     */
    public function mentorRegistration()
    {
        return $this->belongsTo('App\MentorRegistration', 'mentor_regis_id');
    }

    // Model Function
    /**
     * Create and save new mentor registration experience
     *  
     */
    public static function createNewMentorRegistrationExperience(
        $mentorRegisID, 
        $mentorHasExp, 
        $mentorExpText, 
        $mentExpEntre, 
        $mentoring, 
        $howHearProgram
        )
    {
        return MentorRegistrationExperience::create([
            'mentor_regis_id' => $mentorRegisID,
            'mentor_has_exp' => $mentorHasExp,
            'mentor_exp_text' => $mentorExpText,
            'mentor_exp_entrepreneuship' => $mentExpEntre,
            'mentoring' => $mentoring,
            'how_hear_program' => $howHearProgram,
        ]);
    }
}
