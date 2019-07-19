<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PRDirectorApproval;
use App\CBIEVStaff;
use App\Jobs\CreateNewProject;

class PRDirectorApprovalController extends Controller
{
    /**
     * 
     */
    public static function newApproval($statusID)
    {
        $directorApproval = new PRDirectorApproval();
        $directorApproval-> approved_by = CBIEVStaff::where('role', '3')->first()-> id;
        $directorApproval-> is_recommended = null;
        $directorApproval-> comment = null;
        $directorApproval-> is_completed = 0;
        $directorApproval-> pr_status_tracking_id = $statusID;
        $directorApproval-> completed_at = null;
        $directorApproval-> save();

        return $directorApproval-> id;
    }

    /**
     * 
     */
    public function showApprovalForm($recID)
    {
        return view('form.recommendation.project_approval_form',['type' => 4, 'recID' => $recID]);
    }

    /**
     * 
     */
    public function saveApproval(Request $request)
    {
        $app = PRDirectorApproval::find();
        $app-> approval = $request-> is_recommended;
        $app-> comment = $request-> comment;
        if ($request-> approval == 1) {
            $app-> isComplated = 1;
            $prID = $app-> prStatus-> projectRegistration-> id;
            CreateNewProject::dispatch($prID)->delay(now()->addSeconds(3));
        } else if ($request-> approval == 0){
            $app-> isComplated = 2;
        }
        
        $app-> save();
    }
}