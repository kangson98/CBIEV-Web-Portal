<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvestorRegistrationStatusTracking;
use App\InvestorRegistration;
use App\CBIEVStaff;
use App\IRManagerRecommendation;
use App\IRManagerRecommendationLog;
use App\IRDirectorApproval;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\IRDirectorApprovalLog;

class InvestorRegistrationStatusTrackingController extends Controller
{

    /**
     * 
     */
    public function startApprovalProcess($id, $stage)
    {
        $investorRegistration = InvestorRegistration::find($id);
        $this-> startManagerRecommendation($investorRegistration);
        return redirect()->back();
    }
    /**
     * 
     */
    public static function startManagerRecommendation($investorRegistration)
    {
        $statusTrackingID = InvestorRegistrationStatusTracking::newManagerRecommendationStatus($investorRegistration-> id)-> id;

        $manager = CBIEVStaff::where('role', 2)-> get()-> first();

        $managerRecommendation = IRManagerRecommendation::createNewRecommendation($statusTrackingID, $manager-> id);
        
        $managerRecommendationID = $managerRecommendation-> id;
                
        $url = self::generateURLStatic($managerRecommendationID, 1);
        
        $managerRecommendation-> updateURL($url);

        EmailController::irManagerRecommendation($manager-> email, $manager-> name, $investorRegistration-> company_registered_name, $url);

        IRManagerRecommendationLog::createNewNotifiedLog($managerRecommendationID);
    }
    /**
     * 
     */
    public static function startDirectorApproval($investorRegistration)
    {
        $statusTrackingID = InvestorRegistrationStatusTracking::newDirectorApprovalStatus($investorRegistration-> id)-> id;

        $director = CBIEVStaff::where('role', 3)-> get()-> first();

        $directorApproval = IRDirectorApproval::createNewDirectorApproval($statusTrackingID, $director-> id);

        $directorApprovalID = $directorApproval-> id;

        $url = self::generateURLStatic($directorApprovalID, 2);

        $directorApproval->updateURL($url);

        EmailController::irDirectorApproval($director-> email, $director-> name, $investorRegistration-> company_registered_name, $url);

        IRDirectorApprovalLog::createNewNotifiedLog($directorApprovalID);
    }

    /**
     * 
     */
    public static function generateURLStatic($recID, $type)
    {
        $cryptedRecID = Crypt::encrypt($recID);

        switch ($type) {
            case 1:
                return URL::temporarySignedRoute('investor.recommendation.manager.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 2:
                return URL::temporarySignedRoute('investor.approval.get', now()->addMinutes(2880), ['appID'=> $cryptedRecID]);
                break;
        }
    }
}
