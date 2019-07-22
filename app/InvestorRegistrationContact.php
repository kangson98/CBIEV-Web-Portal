<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestorRegistrationContact extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'investor_registration_contacts';

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
     * 
     */
    public function InvestorRegistration()
    {
        return $this-> belongsTo('App\InvestorRegistration', 'investor_regis_id');
    }

    // Model function
    /**
     * 
     */
    public static function createNewContact($investorRegisID, $contactType, $contactDetail)
    {
        return InvestorRegistrationContact::create([
            'investor_regis_id' => $investorRegisID,
            'contact_type' => $contactType,
            'contact_detail' => $contactDetail
        ]);
    }

    /**
     * Create new HP contact
     * 
     * 
     */
    public static function newHPContact($investorRegisID, $contactDetail)
    {
        self::createNewContact($investorRegisID, 1, $contactDetail);
    }
    /**
     * Create new HP contact
     * 
     * 
     */
    public static function newTelContact($investorRegisID, $contactDetail)
    {
        self::createNewContact($investorRegisID, 2, $contactDetail);
    }
    /**
     * Create new HP contact
     * 
     * 
     */
    public static function newEmailContact($investorRegisID, $contactDetail)
    {
        self::createNewContact($investorRegisID, 3, $contactDetail);
    }
    /**
     * Create new HP contact
     * 
     * 
     */
    public static function newFaxContact($investorRegisID, $contactDetail)
    {
        self::createNewContact($investorRegisID, 4, $contactDetail);
    }
}
