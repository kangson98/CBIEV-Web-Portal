<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MentorRegistration;
use App\MentorRegistrationStatusTracking;
use App\MRDeanHeadRecommendation;
use App\MRManagerRecommendation;
use App\CBIEVStaff;
use App\MRManagerRecommendationLog;
use App\Jobs\MRRecommendationAutoApprove;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\MRDeanHeadRecommendationLog;
use App\MRDirectorApprovalLog;
use App\Jobs\InsertLinkIntoDirectorApprovalManagerRecommendation;
use App\MRDirectorApproval;

class MentorRegistrationStatusTrackingController extends Controller
{
    /**
     * 
     */
    public function startApprovalProcess($id, $stage)
    {
        $mentorRegistration = MentorRegistration::find($id);
        if ($mentorRegistration-> category == 1) {
            $this-> startDeanHeadRecommendation($mentorRegistration);
        }else if ($mentorRegistration-> category == 2){
            $this-> startManagerRecommendation($mentorRegistration);
        }
        return redirect()->back();
    }

    /**
     * 
     */
    public function startDeanHeadRecommendation($mentorRegistration)
    {
        $statusTrackingID = MentorRegistrationStatusTracking::newDeanHeadRecommendationStatus($mentorRegistration-> id)-> id;

        $deanHead = $mentorRegistration-> internalMentorDetail-> centerFaculty-> deanhead;

        $deanHeadRecommendationID = MRDeanHeadRecommendation::createNewDeanHeadRecommendation($statusTrackingID, $deanHead-> id)-> id;

        EmailController::mrDeanHeadRecommendation($deanHead-> email, $deanHead-> name, $mentorRegistration-> name, $this-> generateURL($deanHeadRecommendationID, 2));
        
        MRDeanHeadRecommendationLog::createNewNotifiedLog($deanHeadRecommendationID);

        MRRecommendationAutoApprove::dispatch($statusTrackingID)->delay(now()->addSeconds(5));
    }
    /**
     * 
     */
    public static function startManagerRecommendation($mentorRegistration)
    {
        $statusTrackingID = MentorRegistrationStatusTracking::newManagerRecommendationStatus($mentorRegistration-> id)-> id;

        $manager = CBIEVStaff::where('role', 2)-> get()-> first();

        $managerRecommendation = MRManagerRecommendation::createNewRecommendation($statusTrackingID, $manager-> id);
        
        $managerRecommendationID = $managerRecommendation-> id;
                
        $url = self::generateURLStatic($managerRecommendationID, 2);
        
        $managerRecommendation-> updateURL($url);

        EmailController::mrManagerRecommendation($manager-> email, $manager-> name, $mentorRegistration-> name, $url);

        MRManagerRecommendationLog::createNewNotifiedLog($managerRecommendationID);
    }
    /**
     * 
     */
    public static function startDirectorApproval($mentorRegistration)
    {
        $statusTrackingID = MentorRegistrationStatusTracking::newDirectorApprovalStatus($mentorRegistration-> id)-> id;

        $director = CBIEVStaff::where('role', 3)-> get()-> first();

        $directorApproval = MRDirectorApproval::createNewDirectorApproval($statusTrackingID, $director-> id);

        $directorApprovalID = $directorApproval-> id;

        $url = self::generateURLStatic($directorApprovalID, 3);

        $directorApproval->updateURL($url);

        EmailController::mrDirectorApproval($director-> email, $director-> name, $mentorRegistration-> name, $url);

        MRDirectorApprovalLog::createNewNotifiedLog($directorApprovalID);
    }

    /**
     * 
     */
    public function generateURL($recID, $type)
    {
        $cryptedRecID = Crypt::encrypt($recID);

        switch ($type) {
            case 1:
                return URL::temporarySignedRoute('mentor.recommendation.dean.head.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 2:
                return URL::temporarySignedRoute('mentor.recommendation.manager.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 3:
                return URL::temporarySignedRoute('mentor.approval.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 4:
        }
    }
    /**
     * 
     */
    public static function generateURLStatic($recID, $type)
    {
        $cryptedRecID = Crypt::encrypt($recID);

        switch ($type) {
            case 1:
                return URL::temporarySignedRoute('mentor.recommendation.dean.head.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 2:
                return URL::temporarySignedRoute('mentor.recommendation.manager.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 3:
                return URL::temporarySignedRoute('mentor.approval.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 4:
        }
    }

}
