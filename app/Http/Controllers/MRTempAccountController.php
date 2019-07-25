<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MentorRegistration;
use Illuminate\Support\Facades\Auth;

class MRTempAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:mentor-registration');
    }

    /**
     * 
     */
    public function home()
    {
        if(!(Auth::user()-> is_activated == 0)){
            Auth::logout();
            abort(401);
        }

        return view('temp_account.mentor_registration.home',['mentorRegis' => MentorRegistration::find(Auth::user()-> mentor_registration_id)]);
    }

    /**
     * 
     */
    public function update(Request $request)
    {
        return dd($request);
        // validate
        // Auth::logout();
        // Decrypt encrypted manager registration ID
        try {
            $decryptedMRID = Crypt::decrypt($request-> mrID);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(401);// abort the request 
        }

        // Get mentor registration
        $mentorRegistration = MentorRegistration::find($decryptedMRID);
        $oldMRExp = $mentorRegistration-> mentorRegistrationExperience;
        $newMRExp = $oldMRExp-> duplicate();
        $newMRExp-> update([
            'mentorHasExp' => $request-> mentorHasExp,
            'mentorExpText' => $request-> mentorHasExp,
            'mentorExpEntrepreneuship' => $request-> mentorHasExp,
            'mentoring' => $request-> mentorHasExp,
            'howHearProgram' => $request-> mentorHasExp,
        ]);

        MentorRegistrationChangeLogController::newLog($decryptedMRID, $newMRExp, $oldMRExp);

        
        if (Auth::guard('mentor-registration')->check()) {
            Auth::user()-> deactivate();
        }
        
        SendUpdatedPRNotification::dispatch($decryptedMRID)-> delay(now()-> addSeconds(100));
        return redirect('mr.temp.update.complete');

    }

    /**
     * 
     */
    public function updateComplete()
    {

        return view('project_registration.pr_update_complete');

    }
}
