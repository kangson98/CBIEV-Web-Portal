<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestorRegistration extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'investor_registrations';

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

    // Model Function
    /**
     * Get investor registration business address
     * 
     * @param int $addressType
     * 
     * @return InvestorRegistrationAddressList
     */
    public function getRegisteredAddress($addressType = 1)
    {
        return $this->hasMany('App\InvestorRegistrationAddressList','investor_regis_id')->where('type', $addressType)->first();
    }

    /**
     * Reuse getRegisteredAddress by passing $address type 2 to get investor business address
     * 
     * @return InvestorRegistrationAddressList
     */
    public function getBusinessAddress()
    {
        return getRegisteredAddress(2);
    }

    /**
     * Create and return new mentor registration
     */
    public static function createNewMentorRegistration(
        $companyRegisteredName, 
        $businessRegistrationNo, 
        $padiUpCapital, 
        $companyWebsite, 
        $contactPersonName, 
        $contactPersonPosition

    )
    {
        return InvestorRegistration::create([
            // 'company_registered_name' => $category,
            // 'business_registered_no' => $name,
            // 'paid_up_capital' => $ic,
            // 'company_website' => $contact,
            // 'contact_person_name' => $email,
            // 'contact_person_position' => $company_id,
            // 'tel_no' => $position,
            // 'fax_no' => $position,
            // 'hp_no' => $position,
            // 'email' => $position,
            // 'tel_no' => $position,
            // 'business_classification' => $officialEmail,
            // 'business_description' => $officialEmail,
            // 'area_of_intereseted' => $officialEmail,
            // 'isJoinPanel' => $officialEmail,
            // 'business_classification' => $officialEmail,
        ]);
    } 
}
