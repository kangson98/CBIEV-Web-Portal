<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'addresses';

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
     * Get addrress associate with the address list
     * 
     */
    public function investorRegistrationAddressList()
    {
        return $this->hasOne('App\InvestorRegistrationAddressList', 'address_id');
    }
    // Model Function
    /**
     * Create and save new address
     * 
     * @param String $line1
     * @param String $line2
     * @param String $city
     * @param String $zip
     * @param String $state
     * 
     * @return Address
     */
    public static function createNewAddress(
        $line1,
        $line2,
        $city,
        $zip,
        $state
    )
    {
        return Address::create([
            'line_1' => $line1,
            'line_2' =>$line2,
            'city' => $city,
            'zip' => $zip,
            'state' => $state
        ]);
    } 



    

}
