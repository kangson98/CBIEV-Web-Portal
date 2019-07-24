<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MRManagerRecommendation;
use Illuminate\Support\Facades\Crypt;
use App\MRManagerRecommendationLog;

class MRManagerRecommendationController extends Controller
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
        $managerRecommendation = $this-> find($decryptedRecID);

        $mentorRegis = $managerRecommendation-> statusTracking-> mentorRegistration;

        return view('form.recommendation.mentor_registration.mentor_recommendation',['mentorRegis' => $mentorRegis, 'type' => 2, 'recID' => $decryptedRecID]);
    }

    /**
     * Save manager recommendation
     * 
     */
    public function saveRecommendation(Request $request)
    {
        // decrypt the crypted id
        $decryptedRecID = $this-> decrypt($request-> recID);

        // retrieve the manager recommendation from database
        $managerRecommendation = $this-> find($decryptedRecID);

        // check if the retrieved manager recommendation is completed
        foreach ($managerRecommendation-> managerRecommendationLog as $log) {
            if ($log-> status == 1 || $log-> status == 2) {
                abort(401);// abort the request if the conditions match
            }
        }
        
        // update and save manager recommendation
        $managerRecommendation-> update([
            'is_recommended' => $request-> recommendation,
            'reason' => $request-> recommendationReason,
            'comment' => $request-> recommendationComment
        ]);

        // Log the status
        if ($request-> recommendation == 1) {
            // Log with status 1
            MRManagerRecommendationLog::createNewCompleteRecommendedLog($decryptedRecID);
        }else{
            // Log with status 2
            MRManagerRecommendationLog::createNewCompleteNotRecommendedLog($decryptedRecID);
        }
        
        MentorRegistrationStatusTrackingController::startDirectorApproval($managerRecommendation-> statusTracking-> mentorRegistration);
        //redirect 
        // return redirect(route('mentor.registration.detail',['id' => $decryptedRecID]));
        return 'manager rec';
    }

    /**
     * Find the recommendation using id
     * 
     */
    public function find($id)
    {
        return MRManagerRecommendation::find($id)->first();
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
