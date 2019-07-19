<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvestorRegistration;

class InvestorRegistrationController extends Controller
{
    /**
     * Show mentor registration form
     * 
     * @return View view
     */
    public function showRegistrationForm()
    {
        return view('form.registration.investor.investor_registration_form');
    }

    /**
     * Save mentor registration 
     * 
     * @param Request $request
     */
    public function saveRegistration(Request $request)
    {
        return dd($request);
        // validate

        // save investor registration
        InvestorRegistration::saveNewInvestorRegistration();
        // save investor registration address

        // attact address to investor registration

        // redirect 
    }
}
