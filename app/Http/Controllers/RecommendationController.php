<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\PRSupervisorRecommendation;
use App\ProjectRegistrationStatusTracking;
use App\PRDeanHeadRecommendation;
use App\PRManagerRecommendation;
use Carbon\Carbon;
use App\Jobs\PRNotRecommended;

class RecommendationController extends Controller
{
    /**
     * 
     */
    public function projectRecommendation(Request $request, $cryptedType, $cryptedRecID)
    {

        if (! $request->hasValidSignature()) {
            abort(404);
        }
        try {
            $decryptedType = Crypt::decrypt($cryptedType);
            $decryptedRecID = Crypt::decrypt($cryptedRecID);
        } catch (DecryptException $e) {
            abort(404);
        }
        // return dd($decryptedType, $decryptedRecID);

        switch ($decryptedType) {
            case 1:
                $prRec = PRSupervisorRecommendation::find($decryptedRecID);
                $person = $prRec-> prSupervisor;
                $projectRegis = $prRec-> prStatus -> projectRegistration;
                break;
            case 2:
                $prRec = PRDeanHeadRecommendation::find($decryptedRecID);
                $person = $prRec-> deanHead;
                $projectRegis = $prRec-> prStatus -> projectRegistration;
                break;
            case 3:
                $prRec = PRManagerRecommendation::find($decryptedRecID);
                $person = $prRec-> manager;
                $projectRegis = $prRec-> prStatus -> projectRegistration;
                break;
        }
        return view('form.recommendation.project_recommendation_form',['type' => $decryptedType, 'person' => $person, 'recID' => $decryptedRecID])
        ->with('projectRegis', $projectRegis);
    }

    /**
     * 
     */
    public function saveRecommendation(Request $request)
    {

        //validation 
        $statusID = null;
        try {
            $decryptedType = Crypt::decrypt($request-> type);
            $decryptedRecID = Crypt::decrypt($request-> recID);
        } catch (DecryptException $e) {
            abort(401);
        }
        $recommendation_ = (int)$request-> recommendation;

        switch ($decryptedType) {
            case 1:
                $prSupRec = PRSupervisorRecommendation::find($decryptedRecID);
                $this-> checkRecommendationIsCompleted($prSupRec);
                $prSupRec-> comment = $request-> recommendationComment;
                $prSupRec-> is_recommended = $request-> recommendation;
                $prSupRec-> is_completed = $this-> checkRecommendation($request-> recommendation);
                $prSupRec-> completed_at =  Carbon::now();
                $prSupRec-> save();
                $statusID = $prSupRec-> pr_status_tracking_id;
                break;
            case 2:
                $prDeanHeadRec = PRDeanHeadRecommendation::find($decryptedRecID);
                $this-> checkRecommendationIsCompleted($prDeanHeadRec);
                $prDeanHeadRec-> comment = $request-> recommendationComment;
                $prSupRec-> is_recommended = $request-> recommendation;
                $prDeanHeadRec-> completed_at =  Carbon::now();
                $prDeanHeadRec-> is_completed = $this-> checkRecommendation($request-> recommendation);
                $prDeanHeadRec-> save();
                $statusID = $prDeanHeadRec-> pr_status_tracking_id;
                break;
            case 3:
                $prManager = PRManagerRecommendation::find($decryptedRecID);
                $this-> checkRecommendationIsCompleted($prManager);
                $prManager-> comment = $request-> recommendationComment;
                $prSupRec-> is_recommended = $request-> recommendation;
                $prManager-> is_completed = $this-> checkRecommendation($request-> recommendation);
                $prManager-> completed_at = Carbon::now();
                $prManager-> save();
                $statusID = $prManager-> pr_status_tracking_id;
                break;
        }
        
        if ($recommendation_ == 1) {
            
            $this-> checkAllRecommendationCompletion($statusID, $decryptedType);

        }else if($recommendation_ == 0){

            PRNotRecommended::dispatch($decryptedType, $decryptedRecID)->delay(now()->addSeconds(5));

        }
        
    }

    /**
     * 
     */
    public function checkAllRecommendationCompletion($statusID, $type)
    {
        $isComplete =  true;
        $statusTracking = ProjectRegistrationStatusTracking::find($statusID);
        switch ($type) {
            case 1:
                $isComplete = $this-> checkRecIsCompleted($statusTracking-> supervisorRecommendation);
                break;
            case 2:
                $isComplete = $this-> checkRecIsCompleted($statusTracking-> deanHeadRecommendation);
                break;
            case 3:
                $isComplete = $this-> checkRecIsCompleted($statusTracking-> managerRecommendation);
                break;
            default:
                $isComplete = false;
                break;
        }

        if ($isComplete == true ) {
            $prstController = new ProjectRegistrationStatusTrackingController;
            switch ($statusTracking-> project_registration_status) {
                case 1:
                case 7:
                    $prstController-> startDeanHeadRecommendation($statusTracking-> project_registration_id);
                    break;
                case 2:
                case 8:
                    $prstController-> startManagerRecommendation($statusTracking-> project_registration_id);
                    break;
                case 3:
                case 9:
                    $prstController-> startDirectorApproval($statusTracking-> project_registration_id);
                    break;
            }
        }
    }

    /**
     * To check completed project registration recommendation and abort the request for completed recommendation 
     * 
     * @param Integer $type
     * @param Integer $rec
     */
    public function checkRecommendationIsCompleted($rec)
    {
        if ($rec-> is_completed === 1) {
            abort(401);
        }
    }

    /**
     * check if each entry of project recommendation is completed
     * 
     * @param PRSupervisorProjectRecommendation/PRDeanHeadProjectRecommendation/PRManagerProjectRecommendation $recEntry
     * 
     * @return Boolean
     */
    public function checkRecIsCompleted($recEntry)
    {
        foreach ($recEntry as $rec) {
            if ($rec-> is_completed === 1 || $rec-> is_completed === 2 ) {
                return true;
            }else{
                return  false;
            }
        }
    }

    /**
     * 
     */
    public function checkRecommendation($recommendation)
    {
        if ($recommendation == 1) {
            return 1;
        }else if($recommendation == 0){
            return 2;
        }
    }
}
