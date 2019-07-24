<?php

namespace App\Http\Controllers\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InvestorRegistration;

class StaffInvestorRegistrationController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:cbiev-staff');
    }
    /**
     * Show mentor registration list view
     * 
     */
    public function showInvestorRegistrationList()
    {
        return view('CBIEVStaff.registration.investor.investor_regis_list')->with('investorRegistrations', InvestorRegistration::all());
    }
    /**
     * Show project registration list view
     * 
     */
    public function showInvestorRegistrationDetail($id)
    {
        return view('CBIEVStaff.registration.investor.investor_regis_detail')->with('investorRegis', InvestorRegistration::find($id));
    }
}
