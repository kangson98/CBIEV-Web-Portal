<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programme;
use App\CenterFaculty;

class ProgrammeController extends Controller
{
    public function func(){

        return json_encode(CenterFaculty::find(17)->programme);
        return dd(Programme::find(1)->centerFaculty->name);
    }
}
