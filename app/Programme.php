<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    /**
     * Table name for this model
     */
    protected $table = 'programmes';
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
    
    /**
     * To retrieve id by programme name
     * 
     * @param String programme_name
     * 
     * @return Integer
     * 
     */
    public static function getIDByProgrammeName($programmeName){
        return Programme::where('programme_name', $programmeName)->first()->id;
    }

    /**
     * Get the programme associated with the center/faculty.
     * 
     */
    public function centerFaculty()
    {   
        return $this->belongsTo('App\centerFaculty', 'center_faculty_id');
    }
}
