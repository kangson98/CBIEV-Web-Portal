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
    /**
     * Get the contact associate with the investor registration
     * 
     */
    public function contact()
    {
        return $this-> hasMany('App\InvestorRegistrationContact', 'investor_regis_id');
    }
    /**
     * Get the contact associate with the investor registration
     * 
     */
    public function contactPerson()
    {
        return $this-> hasMany('App\InvestorRegistrationContactPerson', 'investor_regis_id');
    }
    /**
     * Get investor registration associate to the address list
     * 
     * @return InvestorRegistration
     */
    public function addressList()
    {
        return $this->hasMany('App\InvestorRegistrationAddressList', 'investor_regis_id');
    }

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
    public static function createNewInvestorRegistration(
        $companyRegisteredName, 
        $businessRegistrationNo, 
        $padiUpCapital, 
        $companyWebsite, 
        $businessClassification,
        $businessDescription,
        $areaOfIntereseted,
        $isJoinPanel

    )
    {
        return InvestorRegistration::create([
            'company_registered_name' => $companyRegisteredName,
            'business_registered_no' => $businessRegistrationNo,
            'paid_up_capital' => $padiUpCapital,
            'company_website' => $companyWebsite,
            
            'business_classification' => $businessClassification,
            'business_description' => $businessDescription,
            'area_of_intereseted' => $areaOfIntereseted,
            'is_join_panel' => $isJoinPanel,
        ]);
    } 

    /**
     * Get the lastest status tracking of status for current project 
     * 
     */
    public function statusTrackingLatest(){

        return $this->hasMany('App\InvestorRegistrationStatusTracking', 'investor_regis_id')-> orderBy('created_at', 'desc')-> first();

    } 
}
