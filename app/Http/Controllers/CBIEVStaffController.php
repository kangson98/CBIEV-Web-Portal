<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CBIEVStaffController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:cbiev-staff');
    }
    
    /**
     * Show staff home dashboard
     * 
     * @return View view
     */
    public function showStaffHome(){
        return view('CBIEVStaff.home');
    }
}
