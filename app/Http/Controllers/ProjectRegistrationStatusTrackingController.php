<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProjectRegistration;
use App\ProjectRegistrationStatusTracking;
use Illuminate\Support\Facades\DB;
use App\CenterFaculty;
use App\CBIEVStaff;
use App\Jobs\PRRecommendationAutoApprove;

use App\ProjectRegistrationChangeLog;
use App\PRTempAccount;
use App\Jobs\SendUpdatedPRNotification;
use App\MRDeanHeadRecommendation;
use App\MentorRegistrationStatusTracking;
use Illuminate\Support\Facades\Hash;

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
        $managerRecommendationID = PRManagerRecommendationController::newRecommendation($statusID);
        $manager = CBIEVStaff::where('role', 2)-> get()-> first();
        EmailController::managerRecommendation($manager-> email, $managerRecommendationID, $manager-> name);

        PRRecommendationAutoApprove::dispatch($statusID)->delay(now()-> addSeconds(100));
    }

    /**
     * 
     */
    public function startDirectorApproval($projectRegisID)
    {
        $statusID = $this-> newStatus($projectRegisID, 4);
        $directorApprovalID = PRDirectorApprovalController::newApproval($statusID);
        $director = CBIEVStaff::where('role', 3)-> get()-> first();
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
        return dd(MentorRegistrationStatusTracking::where('mentor_regis_id', 1)->where('mentor_registration_status', 2)->orderBy('created_at', 'desc')-> first()-> managerRecommendation);
        $a = MentorRegistrationStatusTracking::find(2)->attributesToArray();
        // return dd(Hash::make(970303055007));
        return dd(array_keys(($a[0])));
        SendUpdatedPRNotification::dispatch(1)->delay(now()-> addSeconds(100));

        // EmailController::reRunProjectRecommendationNotification('a@mail.com', 'b@mail.com', 'Zi Xuan', 2, 'ROCKET VIAl', 1);
        return 'true';
        $a = '\App\CBIEVStaff';
        return dd(
        $status = $a::find(1));
        $a = PRTempAccount::findorfail(2);
        return $a;

        // try {
        //     PRTempAccount::findorfail(2);
        //     return 'true';
        // } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        //     return 'false';
        // }

        // return dd(PRTempAccount::findorfail(1));
        // $sup = ProjectSupervisor::find(1);
        // $sup-> update([
        //     'ic' => 1111,
        //     'contact' => 0222
        // ]);

        // return dd($sup);
        // return dd(ProjectRegistration::find(1) ->getTableColumns());
        // if (strcasecmp ('abc', 'abc')) {
        //     return 1;
        // }else{
        //     return 2;
        // }

        // return dd(route('project.regisration.approval.start',[1,2]));
        // return Carbon::now()-> toDateTimeString();
        $a = new EmailController;
        $a->managerRecommendation('manager@mail.com', 1, 3);
    }



}
