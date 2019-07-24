<?php

namespace App\Http\Controllers\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectRegistration;

class StaffProjectRegistrationController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth:cbiev-staff');
    }
    /**
     * Show project registration list view
     * 
     */
    public function showProjectRegistrationList()
    {
        return view('CBIEVStaff.registration.project.project_regist_list')->with('projectRegistrations', ProjectRegistration::all());
    }
    /**
     * Show project registration list view
     * 
     */
    public function showProjectRegistrationDetail($id)
    {
        return view('CBIEVStaff.registration.project.project_regist_detail')->with('projectRegis', ProjectRegistration::find($id));
    }
}
