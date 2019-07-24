<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MRDirectorApprovalLog;
use Illuminate\Support\Facades\Crypt;
use App\MRDirectorApproval;

class MRDirectorApprovalController extends Controller
{
    /**
     * Show Recommendation Form
     */
    public function showRecommendationForm(Request $request, $recID)
    {
        if (! $request->hasValidSignature()) {
            abort(404);
        }

        $decryptedRecID = $this-> decrypt($recID);
        $directorApproval = $this-> find($decryptedRecID);

        $mentorRegis = $directorApproval-> statusTracking-> mentorRegistration;

        return view('form.recommendation.mentor_registration.mentor_recommendation',['type' => 3, 'recID' => $decryptedRecID]);
    }

    /**
     * Save manager recommendation
     * 
     */
    public function saveRecommendation(Request $request)
    {
        // decrypt the crypted id
        $decryptedRecID = $this-> decrypt($request-> appID);

        // retrieve the manager recommendation from database
        $directorApproval = $this-> find($decryptedRecID);

        // check if the retrieved manager recommendation is completed
        foreach ($directorApproval-> managerRecommendationLog as $log) {
            if ($log-> status == 1 || $log-> status == 2) {
                abort(401);// abort the request if the conditions match
            }
        }
        
        // update and save manager recommendation
        $directorApproval-> update([
            'is_recommended' => $request-> approval,
            'reason' => $request-> approvalReason,
            'comment' => $request-> approvalComment
        ]);

        // Log the status
        if ($request-> recommendation == 1) {
            // Log with status 1
            MRDirectorApprovalLog::createNewCompleteRecommendedLog($decryptedRecID);
        }else{
            // Log with status 2
            MRDirectorApprovalLog::createNewCompleteNotRecommendedLog($decryptedRecID);
        }
        
        MentorRegistrationStatusTrackingController::startDirectorApproval($directorApproval-> statusTracking-> mentorRegistration);
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
        return MRDirectorApproval::find($id)->first();
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
        return $decryptedInput;
    }
}
