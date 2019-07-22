<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestorRegistrationContactPerson extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'investor_registration_contact_people';

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
     * Get the investor registration that owns the contact person
     */
    public function investorRegistration()
    {
        return $this-> belongsTo('App\InvestorRegistration', 'investor_regis_id');
    }

    // Model Function
    /**
     * Create and save new contact person
     * @param UnsignedBigInteger $investorRegisID
     * @param String $contacPersonName
     * @param String $contactPersonPosition
     * 
     * @return ContactPerson
     */
    public static function createNewContactPerson(int $investorRegisID, String $contactPersonName, String $contactPosition)
    {
        return InvestorRegistrationContactPerson::create([
            'investor_regis_id' => $investorRegisID,
            'contact_person_name' => $contactPersonName,
            'contact_person_position' => $contactPosition
        ]);
    }
}
