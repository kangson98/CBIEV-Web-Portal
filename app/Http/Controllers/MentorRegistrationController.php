<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\MentorRegistration;
use App\InternalMentorDetail;
use App\CenterFaculty;
use App\MentorRegistrationExperience;

class MentorRegistrationController extends Controller
{
    /**
     * Show mentor registration form
     * 
     * @return View view
     */
    public function showRegistrationForm()
    {
        $centerFaculty = CenterFaculty::all()-> pluck('id', 'name');
        return view('form.registration.mentor.mentor_registration_form', ['centerFaculty' => $centerFaculty]);
    }

    /**
     * Save mentor registration 
     * 
     * @param Request $request
     */
    public function saveRegistration(Request $request)
    {
        // return dd($request-> mentorHasCompany);
        // return dd($request);
        // validation
        // check company exist and save
        if ($request-> mentorHasCompany == "true") {
            $companyID = Company::checkCompanyIsExistOrCreateNew($request-> mentorCompanyRegNo, $request-> mentorCompanyName)-> id;
        }else{
            $companyID = null;
        }

        // save mentor registration
        $newMentorRegistration = MentorRegistration::createNewMentorRegistration(
            $request-> mentorCategory,
            $request-> mentorName,
            $request-> mentorICPass,
            $request-> mentorContact,
            $request-> mentorEmail,
            $companyID,
            $request-> mentorPosition,
            $request-> mentorCompanyEmail
        );

        // set mentor type sync pivot table
        if($request-> has('mentorTypeBusi') && $request-> mentorTypeBusi == 'on'){// for business mentor
            $newMentorRegistration-> syncMentorTypeBusiness();
        }
        if($request-> has('mentorTypeTech') && $request-> mentorTypeTech == 'on'){// for technical mentor
            $newMentorRegistration-> syncMentorTypeTechnical();
        }
        // if internal save internal mentor detail
        if ($request-> mentorCategory == 1) {
            InternalMentorDetail::createNewInternalMentorDetail($newMentorRegistration-> id, (int)$request-> mentorDepartment);
        }
        // save mentor exp 
               
        MentorRegistrationExperience::createNewMentorRegistration(
            $newMentorRegistration-> id, 
            $request-> mentorHasExp, 
            $request-> mentorExpText, 
            $request-> mentorExpEntrepreneuship, 
            $request-> mentoring, 
            $request-> howHearProgram, 
            $request-> mentorCategory
        );
        
        // redirect registration summary

    }
}
