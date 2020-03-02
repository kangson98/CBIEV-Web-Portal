<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProjectMember;
use App\Programme;
use App\ProjectRegistration;
use App\ProjectSupervisor;
use App\Company;
use App\CenterFaculty;
use App\ProjectRegistrationStatusTracking;


class ProjectRegistrationController extends Controller
{
    public  $project;
    public  $member;
    public  $supervisor;
    private  $memberProgrammes = [];
    private $ucID;
    private $center_faculty_id;
    private $companyID;
    /**
     *
     * To show project registration page to user
     *
     * @return view
     */
    public function showRegistrationPage()
    {
        return view('form.registration.project_registration.project_registration_forms');
    }

    /**
     * To sanitize input
     * 
     * @param Request $request
     */
    public function sanitize(Request $request){

       if ($request->has('memberProgramme')) {
        $this->memberProgrammes = array_values(array_filter($request-> memberProgramme));
       }
    }

    /**
     *
     * To save project registration page into database
     *
     * @param Request $request
     *
     * @return view
     */
    public function submitRegistration(Request $request)
    {
        // return dd($request);
        $start = microtime(true);
        $this->sanitize($request);
        $teamLeader = $this->saveProjectTeamleader($request);

        $projectRegistration = $this->saveProjectRegistration($request, $teamLeader);
        $this->saveProjectParticipant($request, $projectRegistration);
        $this->saveProjectSupervisor($request, $projectRegistration);
        $this->statusTrackingSubmited($projectRegistration-> id);
        EmailController::successProjectRegistrations($teamLeader, $projectRegistration-> id, $projectRegistration-> project_title);
        $time_elapsed_secs = microtime(true) - $start;
        echo $time_elapsed_secs;
    }
    
    /**
     * Check and set department for alumni and public member type
     * 
     * @param Integer $memberType
     */
    public function checkAlumni($memberType){
        if ($memberType == 3 ) {
            return 1;
        }else if($memberType == 4){
            return 0;
        }
    }
    
    /**
     * To save project leader into database
     *
     * @param Request $request
     *
     */
    public function saveProjectTeamleader($request)
    {
        $ucID = '';
        $center_faculty_id = '';
        $programme = '';

        $companyID = $this->hasCompany($request->leaderHasCompany, $request->leaderCompanyRegNo ,$request->leaderCompanyName);// get Company ID(if applicable)

        switch ($request-> leaderType) {
            case 1:// TAR UC Student
                $ucID = $request-> leaderUCID;
                $center_faculty_id =  CenterFaculty::getIDByCode($request-> leaderDepartment);
                $programme = Programme::getIDByProgrammeName($request-> leaderProgramme);
                break;
            case 2:// TAR UC Staff
                $ucID = $request-> leaderUCID;
                $center_faculty_id =  CenterFaculty::getIDByCode($request-> leaderDepartment);
                $programme = null;
                break;
            case 3:// Alumni
                $ucID = $request-> leaderUCID;
                $center_faculty_id =  null;
                $programme = null;
                break;
            case 4:// Public
                $ucID = null;
                $center_faculty_id =  null;
                $programme = null;
                break;
        }

        return ProjectMember::firstOrCreate(
            ['ic' => $request-> leaderIC],
            [
                'member_type' =>  $request-> leaderType,
                'name' => $request-> leaderName,
                'contact' => $request-> leaderContact,
                'email' => $request-> leaderEmail,
                'uc_id' => $ucID,
                'company_id' => $companyID,
                'company_email' => $request-> leaderCompanyEmail,
                'position' => $request-> leaderPosition,
                'center_faculty_id' => $center_faculty_id,
                'programme_study' => $programme,
                'is_active' => 1
            ]
        );
    }

    /**
     * To save project registration into database
     *
     * @param Request $request
     * @param ProjectParticipant $teamLeader
     *
     * @return ProjectRegistration $projectRegistration
     *
     */
    public function saveProjectRegistration($request, $teamLeader)
    {
        $projectRegistration = ProjectRegistration::projectRegistration();

        $projectRegistration -> project_title = $request-> projectTitle;
        $projectRegistration -> problem_statement = $request-> projectstate;
        $projectRegistration -> product_solution = $request-> prodSol;
        $projectRegistration -> target_market = $request-> targetMark;

        switch ($request-> projectCategory) {
            case '1':
                $projectRegistration -> category_id = 1;
                break;
            case '2':
                $projectRegistration -> category_id = 2;
                break;
            case '3':
                $projectRegistration -> category_id = 3;
                break;
            case '4':
                $projectRegistration -> category_id = 4;
                break;
            case '5':
                $projectRegistration -> category_id = 6;
                break;
            case '6':
                $projectRegistration -> category_id = 7;
                break;
            case '7':
                $projectRegistration -> category_id = 8;
                break;
        }

        $projectRegistration -> team_leader = $teamLeader -> id;
        $projectRegistration -> save();

        $projectRegistration -> projectMember() -> sync($teamLeader, false);

        return $projectRegistration;
    }

    /**
     * To save each participant into database and link with project registration
     *
     * @param Request $request
     * @param ProjectRegistration $projectRegistration
     *
     */
    public function saveProjectParticipant($request, $projectRegistration)
    {   
        $programme = '';
        if ($request-> participantIndex > 0) {
            for ($i=0; $i < $request-> participantIndex; $i++) {
                $companyID = $this->hasCompany($request-> memberHasCompany[$i], $request-> memberCompanyRegNo[$i], $request-> memberCompanyName[$i]);
                switch ($request-> memberType[$i]) {
                    case 1:// TAR UC Student
                        $this->ucID = $request-> memberUCID[$i];
                        $this->center_faculty_id =  CenterFaculty::getIDByName($request-> memberDepartmentCode[$i]);
                        $programme = Programme::getIDByProgrammeName($this->memberProgrammes[$i]);
                        break;
                    case 2:// TAR UC Staff
                        $this->ucID = $request-> memberUCID[$i];
                        $this->center_faculty_id =  CenterFaculty::getIDByName($request-> memberDepartmentCode[$i] );
                        $programme = null;
                        break;
                    case 3:// Alumni
                        $this->ucID = $request-> memberUCID[$i];
                        $this->center_faculty_id =  null;
                        $programme = null;
                        break;
                    case 4:// Public
                        $this->ucID = null;
                        $this->center_faculty_id =  null;
                        $programme = null;
                        break;
                }
                $projectMember = ProjectMember::firstOrCreate(
                    ['ic' => $request-> memberIC[$i]],
                    [
                        'member_type' =>  $request-> memberType[$i],
                        'name' => $request-> memberName[$i],
                        'contact' => $request-> memberContact[$i],
                        'email' => $request-> memberEmail[$i],
                        'uc_id' => $this->ucID,
                        'company_id' => $companyID,
                        'company_email' => $request-> memberCompanyEmail[$i],
                        'position' => $request-> memberPosition[$i],
                        'center_faculty_id' => $this->center_faculty_id,
                        'programme_study' => $programme,
                        'is_active' => 1
                    ]
                );

                // return dd($projectMember);
                $projectRegistration -> projectMember() -> sync($projectMember, false);
            }
        }
    }

    /**
     * To save each supervisor and link with project registration
     *
     */
    public function saveProjectSupervisor($request, $projectRegistration)
    {
        $supUCID = '';
        if ($request-> supervisorIndex > 0) {
            for ($i=0; $i < $request-> supervisorIndex; $i++) {

                if ($request-> supervisorType[$i] == 2) {// TAR UC Staff
                    $supUCID = $request-> supervisorUCID[$i];
                    $this->center_faculty_id =  CenterFaculty::getIDByName($request-> supervisorDepartmentCode[$i] );
                    $this->companyID =  1;
                } else {
                    $companyID = $this->hasCompany($request-> supervisorHasCompany[$i], $request-> supervisorCompanyRegNo[$i], $request-> supervisorCompanyName[$i]);
                    switch ($request-> supervisorType[$i]) {
                        case 3:// Alumni
                            $supUCID = $request-> supervisorUCID[$i];
                            $this->center_faculty_id =  null;
                            break;
                        case 4:// Public
                            $supUCID = null;
                            $this->center_faculty_id =  null;
                            break;
                    }
                }
                
                $projectSupervisor = ProjectSupervisor::firstOrCreate(
                    ['ic' => $request-> supervisorIC[$i]],
                    [

                        'member_type' => $request-> supType[$i],
                        'name' => $request-> supervisorName[$i],
                        'contact' => $request-> supervisorContact[$i],
                        'email' => $request-> supervisorEmail[$i],
                        'company_id' => $companyID,
                        'company_email' => $request-> supervisorCompanyEmail[$i],
                        'position' => $request-> supervisorPosition[$i],
                        'uc_id' => $supUCID,
                        'center_faculty_id' => $this->center_faculty_id,
                    ]
                );
                $projectRegistration -> projectSupervisor() -> sync($projectSupervisor, false);
            }
        }
    }

    /**
     * Check if current person has comapany
     */
    public function hasCompany($hasCompany, $companyRegNo, $companyName)
    {   
        switch ($hasCompany) {
            case true:
                return $this->saveCompany($companyRegNo, $companyName);
                break;
            case false:
                return null;
                break;
            default:
                return null;            
                break;
        }
    }

    /**
     * 
     * To save check existing company or create new company 
     */
    public function saveCompany($companyRegNo, $companyName)
    {
        return (Company::firstOrCreate(
            ['company_reg_no' => $companyRegNo],
            [
                'company_name' => $companyName,
            ]
        )->id);
  
    }
    /**
     * Create status tracking with status 0
     * 
     */
    public function statusTrackingSubmited($project_registration_id)
    {
        $pr_status = new ProjectRegistrationStatusTracking;

        $pr_status-> project_registration_status = 0;
        $pr_status-> project_registration_id = $project_registration_id;
        $pr_status-> save();

    }

    /**
     * 
     */
    public function showLoginForm()
    {
        return view('auth.project_registration.project_registration_login');
    }

    /**
     * 
     */
    public function submitForm()
    {
        return dd('yes');
        
    }
    
}