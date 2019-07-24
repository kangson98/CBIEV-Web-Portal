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

        $managerRecommendationID = MRManagerRecommendation::createNewRecommendation($statusTrackingID);

        $manager = CBIEVStaff::where('role', 2)-> get()-> first();

        $url = self::generateURLStatic($managerRecommendationID, 2);
        EmailController::mrManagerRecommendation($manager-> email, $managerRecommendationID, $manager-> name, $mentorRegistration-> name, $url);

        self::insertLink($url, 2);

        MRManagerRecommendationLog::createNewNotifiedLog($managerRecommendationID);
    }
    /**
     * 
     */
    public static function startDirectorApproval($mentorRegistration)
    {
        $statusTrackingID = MentorRegistrationStatusTracking::newDirectorRecommendationStatus($mentorRegistration-> id)-> id;

        $directorRecommendationID = MRManagerRecommendation::createNewRecommendation($statusTrackingID);

        $director = CBIEVStaff::where('role', 3)-> get()-> first();

        $url = self::generateURLStatic($directorRecommendationID, 3);

        EmailController::mrDirectorApproval($director-> email, $director-> name, $mentorRegistration-> name, $url);

        self::insertLink($url, 3);

        MRDirectorApprovalLog::createNewNotifiedLog($directorRecommendationID);

    }

    /**
     * 
     */
    public function generateURL($recID, $type)
    {
        $cryptedRecID = Crypt::encrypt($recID);

        switch ($type) {
            case 1:
            case 2:
                return URL::temporarySignedRoute('mentor.recommendation.dean.head.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 3:
                return URL::temporarySignedRoute('mentor.recommendation.manager.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 4:
                return URL::temporarySignedRoute('mentor.approval.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
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
            case 2:
                return URL::temporarySignedRoute('mentor.recommendation.dean.head.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 3:
                return URL::temporarySignedRoute('mentor.recommendation.manager.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
            case 4:
                return URL::temporarySignedRoute('mentor.approval.get', now()->addMinutes(2880), ['recID'=> $cryptedRecID]);
                break;
        }
    }

    /**
     * 
     */
    public static function insertLink($url, $type)
    {
        InsertLinkIntoDirectorApprovalManagerRecommendation::dispatch($url, $type)->delay(now()->addSeconds(5));
    }
}
