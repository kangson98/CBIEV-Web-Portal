<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectUploadLogController extends Controller
{
    public function storeUpload(Request $request){
        
        $path = Storage::putFileAs('ProjectFiles', $request->file('projectfiles'), $file->getClientOriginalName(),);
        //sample-  $path = Storage::putFileAs('Images/'.$foldername, $file, 'image1'); //Images/img-1234567/image1
        
    }

    public function viewFile(){

    }
}
