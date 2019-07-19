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
        return $this->hasMany('App\InvestorRegistration','investor_regis_id');
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
}
