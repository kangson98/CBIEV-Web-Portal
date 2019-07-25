<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MRDeanHeadRecommendation;
use App\MRDeanHeadRecommendationLog;
use App\Jobs\MRCreateNewTempAccount;
use Illuminate\Support\Facades\Crypt;

class MRDeanHeadRecommendationController extends Controller
{
    /**
     * Show Recommendation Form
     */
    public function showRecommendationForm(Request $request, $recID)
    {
        if (! $request->hasValidSignature()) {
            abort(404);
        }

        try {
            $decryptedRecID = Crypt::decrypt($recID);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
        $deanHeadRecommendation = MRDeanHeadRecommendation::find($recID);

        $mentorRegis = $deanHeadRecommendation-> statusTracking-> mentorRegistration;
        return view('form.recommendation.mentor_registration.mentor_recommendation',['mentorRegis' => $mentorRegis, 'type' => 2, 'recID' => $decryptedRecID])
            ->with('managerRecommendation', $deanHeadRecommendation);
    }

    /**
     * Save dean head recommendation
     * 
     */
    public function saveRecommendation(Request $request)
    {
        // decrypt the crypted id
        $decryptedRecID = $this-> decrypt($request-> recID);

        // retrieve the manager recommendation from database
        $deanHeadRecommendation = $this-> find($decryptedRecID);

        // check if the retrieved manager recommendation is completed
        foreach ($deanHeadRecommendation-> deanHeadRecommendationLog as $log) {
            if ($log-> status == 1 || $log-> status == 2) {
                abort(401);// abort the request if the conditions match
            }
        }
        
        // update and save manager recommendation
        $deanHeadRecommendation-> update([
            'is_recommended' => $request-> recommendation,
            'reason' => $request-> recommendationReason,
            'comment' => $request-> recommendationComment
        ]);

        $mentorRegistration = $deanHeadRecommendation-> statusTracking-> mentorRegistration;
        // Log the status
        if ($request-> recommendation == 1) {
            // Log with status 1
            MRDeanHeadRecommendationLog::createNewCompleteRecommendedLog($decryptedRecID);
            MentorRegistrationStatusTrackingController::startManagerRecommendation($mentorRegistration);
        }else{
            // Log with status 2
            MRDeanHeadRecommendationLog::createNewCompleteNotRecommendedLog($decryptedRecID);
            MRCreateNewTempAccount::dispatch($mentorRegistration)->delay(now()->addSeconds(5));
        }
        
        //redirect 
        // return redirect(route('mentor.registration.detail',['id' => $decryptedRecID]));
        return 'dean head rec';
    }

    /**
     * Find the recommendation using id
     * 
     */
    public function find($id)
    {
        return MRDeanHeadRecommendation::find($id)->first();
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
    }


}
