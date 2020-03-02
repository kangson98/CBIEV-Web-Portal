<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUploadLog extends Model
{
        /* The table associated with the model.
    *
    * @var string
    */
    protected $table = 'project_upload_logs';

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
        'filename','file_url','file_path','project_id'
    ];
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
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
    protected $casts = [
        
    ];
}
