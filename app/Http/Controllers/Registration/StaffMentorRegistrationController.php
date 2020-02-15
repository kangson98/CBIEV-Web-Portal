<?php

namespace App\Http\Controllers\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MentorRegistration;

class StaffMentorRegistrationController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:cbiev-staff');
    }
    /**
     * Show mentor registration list view
     * 
     */
    public function showMentorRegistrationList()
    {
        return view('CBIEVStaff.registration.mentor.mentor_regis_list')->with('mentorRegistrations', MentorRegistration::all());
    }
    /**
     * Show project registration list view
     * 
     */
    public function showMentorRegistrationDetail($id)
    {
        return view('CBIEVStaff.registration.mentor.mentor_regis_detail')->with('mentorRegis', MentorRegistration::find($id));
    }
}
