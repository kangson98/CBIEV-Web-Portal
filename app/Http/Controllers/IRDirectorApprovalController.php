<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\IRDirectorApproval;
use App\InvestorRegistrationStatusTracking;
use App\IRDirectorApprovalLog;

class IRDirectorApprovalController extends Controller
{
    /**
     * Show Recommendation Form
     */
    public function showApprovalForm(Request $request, $appID)// $appID is crypted
    {
        //check if the request has valid signature
        if (! $request->hasValidSignature()) {
            abort(404);
        }
        // decrypt approval id
        $decryptedRecID = $this-> decrypt($appID);

        // retreive director aprpoval
        $directorApproval = $this-> find($decryptedRecID);

        // retrieve mentor registration
        $investorRegis = $directorApproval-> statusTracking-> investorRegistration;
        $irID = $investorRegis-> id;

        // retreive manager recommendation 1 = manager recommendation status
        $statusTracking = InvestorRegistrationStatusTracking::where('investor_regis_id', $irID)->where('investor_registration_status', 1)->orderBy('created_at', 'desc')-> first();

        // check manager recommedation status for not recommend or recommend
        $managerRec = $statusTracking-> managerRecommendation-> managerRecommendationLog-> sortByDesc('created_at')-> first()-> status;

        if ($managerRec == 1) {
            $approvalType = 1;// if manager recommend
        }else if($managerRec == 2){
            $approvalType = 2;// if manager not recommend
        }
        // return to mentor approval view
        return view('form.recommendation.investor_registration.investor_recommendation',['type' => 2, 'appID' => $appID, 'approvalType' => $approvalType, 'investorRegis' => $investorRegis]);
    }

    /**
     * Save manager recommendation
     * 
     */
    public function saveApproval(Request $request)
    {
        // return dd(gettype((int)$request-> approvalType));
        // decrypt the crypted id
        $decryptedRecID = $this-> decrypt($request-> appID);
        $decryptedApprovalType = $this-> decrypt($request-> approvalType);

        // retrieve the manager recommendation from database
        $directorApproval = $this-> find($decryptedRecID);
        // check if the retrieved manager recommendation is completed
        foreach ($directorApproval-> directorApprovalLog as $log) {
            if ($log-> status == 1 || $log-> status == 2) {
                abort(401);// abort the request if the conditions match
            }
        }
        
        // update director approval comment and reason
        $directorApproval-> update([
            'reason' => 'reason',
            // 'comment' => $request-> reason,
            'comment' => $request-> approvalComment,
        ]);

        $approval = (int)$request-> approval;
        // check approval type 
        switch ((int)$decryptedApprovalType) {
            case 1:
                // check approval and create new approval log
                if ($approval == 1) {
                    IRDirectorApprovalLog::createNewCompleteRecommendedLog($decryptedRecID);
                }elseif($approval == 2){
                    IRDirectorApprovalLog::createNewCompleteNotRecommendedLog($decryptedRecID);
                }
                break;
            case 2:
                // check approval and create new agreement log
                if ($approval ==1) {
                    IRDirectorApprovalLog::createNewCompleteAgreeLog($decryptedRecID);
                }elseif($approval == 2){
                    IRDirectorApprovalLog::createNewCompleteNotAgreeLog($decryptedRecID);
                    InvestorRegistrationStatusTrackingController::startManagerRecommendation($directorApproval-> statusTracking-> investorRegistration);
                }
                break;
            default:
                abort(401);// abort if no match
                break;
        }
     
        //redirect 
        // return redirect(route('mentor.registration.detail',['id' => $decryptedRecID]));
        return 'dire app';
    }

    /**
     * Find the recommendation using id
     * 
     */
    public function find($id)
    {
        //return director approval by id 
        return IRDirectorApproval::find($id)->first();
    }

    /**
     * Decrypt encrypted field
     */
    public function decrypt($inputToDecrypt)
    {
        try {
            // run decrypt
            $decryptedInput = Crypt::decrypt($inputToDecrypt);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);// abort if exception pop
        }
        // return decrypted value
        return $decryptedInput;
    }
}
