<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InvestorRegistrationAddressList extends Pivot
{
    /**
     * Table name for this model
     */
    protected $table = 'investor_registration_address_list';

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
     * Get investor registration associate to the address list
     * 
     * @return InvestorRegistration
     */
    public function investorRegistration()
    {
        return $this->belongsTo('App\InvestorRegistration','investor_regis_id');
    }

    /**
     * Get addrress associate with the address list
     * 
     */
    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }
    // Model Function
    /**
     * Create and save new investor registration address list
     */
    public static function createNewAddressList($investorRegisID, $addressID, $addressType)
    {
        return InvestorRegistrationAddressList::create([
            'investor_regis_id' => $investorRegisID,
            'address_id' => $addressID,
            'address_type' => $addressType
        ]);
    }

    /**
     * Create new address list for registered address
     */
    public static function newRegisteredAddress($investorRegisID, $addressID)
    {
        self::createNewAddressList($investorRegisID, $addressID, 1);
    }
    /**
     * Create new address list for business address
     */
    public static function newBusinessAddress($investorRegisID, $addressID)
    {
        self::createNewAddressList($investorRegisID, $addressID, 2);
    }
}
