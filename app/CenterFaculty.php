<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CenterFaculty extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'center_faculties';
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
    protected $fillable = [
        'name', 'code'
    ];

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

    // Model Relation Function

    /**
     * Get the programme associated with the center/faculty.
     * 
     */
    public function programme()
    {
        return $this->hasMany('App\Programme', 'center_faculty_id');
    }

    public function deanHead()
    {
        return $this->hasOne('App\DeanHead', 'faculty_center_id');
    }
    /**
     * Get the Internal Mentor Registration detail associate to the the center/faculty
     * 
     */
    public function internalMentorDetail()
    {
            return $this->hasMany('App\InternalMentorDetail', 'center_faculty_id');
    }
    // Model Function 

    /**
     * Return id by code
     */
    public static function getIDByCode($code){
        return CenterFaculty::where('code', $code)->first()->id;
    }
    /**
     * Return id by code
     */
    public static function getIDByName($name){
        return CenterFaculty::where('name', $name)->first()->id;
    }

    // Model Mutator
    /**
     * Get the center/facuty/department's code.
     *
     * @param  string  $value
     * @return string
     */
    public function getCodeAttribute($value)
    {
        return strtoupper($value);
    }
}
