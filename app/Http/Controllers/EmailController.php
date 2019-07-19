<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use App\Mail\ProjectRegistrationRecommendationInvitation;
use App\ProjectSupervisor;
use App\Mail\SuccessProjectRegistrationNotification;
use App\Mail\ReRunRecommendationNotification;
use App\Mail\SuccessMentorRegistrationEmailNotification;

class EmailController extends Controller
{
    /**
     * Send Supervisor Recommendation Invitation
     * 
     * @param String $email
     * @param String $companyEmail
     * @param integer $recID
     * 
     */
    public static function supervisorRecommendationInvitation($email, $companyEmail, $recID, $recipient)
    {
        $url = self::generateURL($recID, 1);//pass 1 as type supervisor
        Mail::to([$email, $companyEmail])
            ->send(new ProjectRegistrationRecommendationInvitation($recipient, $url));
    }

    /**
     * Send Dean/HeadDepartment Recommendation Invitation
     * @param String $email
     * @param String $companyEmail
     * @param integer $recID
     */
    public static function deanheadRecommendation($email, $recID, $recipient) 
    {
        $url = self::generateURL($recID, 2);//pass 2 as type dean/head
        Mail::to([$email])
            ->send(new ProjectRegistrationRecommendationInvitation($recipient, $url));
    }

    /**
     * Send Manager Recommendation Invitation
     * @param String $email
     * @param String $companyEmail
     * @param integer $recID
     */
    public static function managerRecommendation($email, $recID, $recipient) 
    {
        $url = self::generateURL($recID, 3);//pass 3 as type manager
        Mail::to([$email])
            ->send(new ProjectRegistrationRecommendationInvitation($recipient, $url));
    }

    /**
     * Send Director Approval Invitation
     * 
     * 
     */
    public static function directorApproval($email, $appID, $recipient)
    {
        $url = self::generateURL($appID, 4);
        Mail::to([$email])
            ->send(new ProjectRegistrationRecommendationInvitation($recipient, $url));
    }

    /**
     * Send Success Project Registration Email notification 
     * 
     * @param   
     * @param
     * @param
     */
    public static function successProjectRegistrations($recipient, $projectID, $projectTitle)
    {
        Mail::to([$recipient-> email, $recipient-> company_email])->later(now()->addSeconds(10), new SuccessProjectRegistrationNotification($recipient-> name, $projectTitle, $projectID));

    }

    /**
     * Re-Notification Project Recommendation\
     * 
     */
    public static function reRunProjectRecommendationNotification($email, $companyEmail, $recipient, $recID, $projectTitle, $type)
    {
        $url = self::generateURL($recID, $type);
        Mail::to([$email, $companyEmail])->later(now()->addSeconds(10),new ReRunRecommendationNotification($recipient, $projectTitle, $url));
    } 

    /**
     * 
     */
    public static function successMentorRegistrations($recipient, $mentorRegisID, $email, $officialEmail)
    {
        Mail::to([$email, $officialEmail])->send(new SuccessMentorRegistrationEmailNotification($recipient, $mentorRegisID));
    } 
 
    /**
     * Generate URL for project registration and approval
     * 
     * @param
     */
    public static function generateURL($recID, $type)
    {
        $cryptedRecID = Crypt::encrypt($recID);
        $cryptedType = Crypt::encrypt($type);

        switch ($type) {
            case 1:
            case 2:
                return URL::temporarySignedRoute('project.recommendation.get', now()->addMinutes(2880), ['type'=> $cryptedType, 'recID'=> $cryptedRecID]);
                break;
            case 3:
                return URL::temporarySignedRoute('project.recommendation.manager.get', now()->addMinutes(2880), ['type'=> $cryptedType, 'recID'=> $cryptedRecID]);
                break;
            case 4:
                return URL::temporarySignedRoute('project.approval.get', now()->addMinutes(2880), ['type'=> $cryptedType, 'recID'=> $cryptedRecID]);
                break;
        }
        return URL::temporarySignedRoute('project.recommendation.get', now()->addMinutes(2880), ['type'=> $cryptedType, 'recID'=> $cryptedRecID]);
    }

    
}
