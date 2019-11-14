<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProjectRegistration;
use App\ProjectRegistrationStatusTracking;
use Illuminate\Support\Facades\DB;
use App\CenterFaculty;
use App\CBIEVStaff;
use App\Jobs\PRRecommendationAutoApprove;

use App\MentorRegistration;

class ProjectRegistrationStatusTrackingController extends Controller
{
    /**
     * 
     */
    public function startApprovalProcess($id, $stage)
    {
        $projectRegis = ProjectRegistration::find($id);
        $stage_ = (int)$stage;
        switch ($stage_) {
            case 1:
                $this-> startSupervisorRecommendation($projectRegis);
                break;
            case 2:
                $this-> startDeanHeadRecommendation($projectRegis);
                break;
            case 3:
                $this-> startManagerRecommendation($projectRegis);
                break;
            case 4:
                $this-> startDirectorApproval($projectRegis);
                break;
            default:
                abort(401);
                break;
        }
        return redirect()->back();
    }

    /**
     *  To start supervisor recommendation
     * @param ProjectRegistration $projectRegis
     * 
     */
    public function startSupervisorRecommendation($projectRegis)
    {
        $statusID = $this-> newStatus($projectRegis-> id, 1);
        foreach ($projectRegis-> projectSupervisor as $supervisor) {
            
            $supRecID = PRSupervisorRecommendationController::newRecommendation($statusID, $supervisor-> id);
            EmailController::supervisorRecommendationInvitation($supervisor-> email, $supervisor-> company_email, $supRecID, $supervisor-> name);
        }

        PRRecommendationAutoApprove::dispatch($statusID)->delay(now()-> addSeconds(100));
    }

    /**
     *  To start dean/head recommendation
     * @param UnsignedBigInt $projectRegisID
     * 
     */
    public function startDeanHeadRecommendation($projectRegisID)
    {
        $statusID = $this-> newStatus($projectRegisID, 2);

        foreach ($this-> centerFacultyEntryCount() as $entryCount) {
            $deanHead = CenterFaculty::find($entryCount-> center_faculty_id)-> deanHead;
            $deanHeadRecID = PRDeanHeadRecommendationController::newRecommendation($statusID, $deanHead-> id);
            EmailController::deanheadRecommendation($deanHead-> email, $deanHeadRecID, $deanHead-> name);
        }

        PRRecommendationAutoApprove::dispatch($statusID)->delay(now()-> addSeconds(100));        
    }

    /**
     * 
     */
    public function startManagerRecommendation($projectRegisID)
    {
        $statusID = $this-> newStatus($projectRegisID, 3);
        $manager = CBIEVStaff::where('role', 2)-> get()-> first();
        $managerRecommendationID = PRManagerRecommendationController::newRecommendation($statusID, $manager->id);
        EmailController::managerRecommendation($manager-> email, $managerRecommendationID, $manager-> name);

        PRRecommendationAutoApprove::dispatch($statusID)->delay(now()-> addSeconds(100));
    }

    /**
     * 
     */
    public function startDirectorApproval($projectRegisID)
    {
        $statusID = $this-> newStatus($projectRegisID, 4);
        $director = CBIEVStaff::where('role', 3)-> get()-> first();
        $directorApprovalID = PRDirectorApprovalController::newApproval($statusID, $director->id);
        EmailController::directorApproval($director-> email, $directorApprovalID, $director-> name);

    }

    /**
     * Start new status for project registration approval process
     */
    public function newStatus($projectRegisID, $statusCode)
    {
        $status = new ProjectRegistrationStatusTracking();
        $status-> project_registration_id = $projectRegisID;
        $status-> project_registration_status = $statusCode;  
        $status-> save();

        return $status-> id;
    }

    /**
     * Static method for starting new status for project registration approval process
     */
    public static function nextStatus($projectRegisID, $statusCode)
    {
        $status = new ProjectRegistrationStatusTracking();
        $status-> project_registration_id = $projectRegisID;
        $status-> project_registration_status = $statusCode;  
        $status-> save();

        return $status-> id;
    }

    /**
     * Get Center/Faculty/Department Member Entry Count
     */
    public function centerFacultyEntryCount()
    {
        return DB::select('SELECT m.center_faculty_id as center_faculty_id, COUNT(m.center_faculty_id) as entry_count
                                FROM project_members m, pr_member_list l
                                WHERE  l.project_member_id = m.id 
                                AND l.project_registration_id = 1
                                GROUP BY m.center_faculty_id
                                HAVING COUNT(m.center_faculty_id) > 0');

    }



    public function mailTo()
    {
        return dd(MentorRegistration::find(2)-> statusTracking-> where('mentor_registration_status', 3)->first()-> directorApproval-> directorApprovalLog-> sortByDesc('created_at')-> first());
    }



}
