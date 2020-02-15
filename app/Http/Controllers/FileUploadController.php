<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public static function upload($path, $targetFile, $name){
        //path, target file, name
        return Storage::putFileAs($path, $targetFile, $name); //name make dynamic
    }
}
