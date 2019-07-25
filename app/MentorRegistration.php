<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorRegistration extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'mentor_registrations';

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
    public function internalMentorDetail()
    {
        if ($this-> category == 1) {
            return $this->hasOne('App\InternalMentorDetail', 'mentor_registration_id');
        }
    }

    /**
     * Get the type associate to the mentor registration
     * 
     */
    public function mentorType()
    {
        return $this-> belongsToMany('App\MentorType', 'mentor_regis_mentor_type', 'mentor_regis_id', 'mentor_type_id');
    }

    /**
     * Get the mentor experience that associate with the mentor
     */
    public function mentorRegistrationExperience()
    {
        return $this->hasOne('App\MentorRegistrationExperience', 'mentor_regis_id');
    }
    /**
     * Get the status tracking associate with the mentor registration
     * 
     */
    public function statusTracking()
    {
        return $this->hasMany('App\MentorRegistrationStatusTracking', 'mentor_regis_id');
    }
    /**
     * Get the company that own the mentor registration
     * 
     */
    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }

    /**
     * Get the Change Log associate with the mentor registration
     * 
     */
    public function changeLog()
    {
        return $this-> hasMany('App\MentorRegistrationChangeLog', 'mentor_registration_id');
    }
    // Model Function
    /**
     * Create and return new mentor registration
     */
    public static function createNewMentorRegistration($category, $name, $ic, $contact, $email, $company_id, $position, $officialEmail)
    {
        return MentorRegistration::create([
            'category' => $category,
            'name' => $name,
            'ic' => $ic,
            'contact' => $contact,
            'email' => $email,
            'company_id' => $company_id,
            'position' => $position,
            'official_email' => $officialEmail,
        ]);
    } 

    /**
     * Sync mentor registration with mentor type business mentor
     * 
     */
    public function syncMentorTypeBusiness($mentorTypeID = 1)
    {
        $this-> mentorType()-> attach($mentorTypeID);
    }
    /**
     * Sync mentor registration with mentor type business mentor
     * 
     */
    public function syncMentorTypeTechnical()
    {
        $this-> syncMentorTypeBusiness(2);
    }

    /**
     * Get the lastest status tracking of status for current project 
     * 
     */
    public function statusTrackingLatest(){

        return $this->hasMany('App\MentorRegistrationStatusTracking', 'mentor_regis_id')-> orderBy('created_at', 'desc')-> first();

    } 

    /**
     * Terminate the mentor registration
     * 
     * @param Integer $id
     */
    public static function terminateMentorRegistration($id)
    {
        try {
            $mentorRegis = MentorRegistration::findOrFail();
            $mentorRegis-> update(
                [
                    'is_terminate' => true
                ]
            );
        } catch (\Throwable $e) {
            abort(401);
        }
    }


}
