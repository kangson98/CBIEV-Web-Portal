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
use App\Mail\MentorRegistrationRecommendationInvitation;
use App\Mail\MentorRegistrationNotRecommendedNotification;
use App\Mail\MentorRegistrationTerminatedNotification;
use App\Mail\MentorRegistrationApprovalInvitation;
use App\Mail\InvestorRegistrationRecommendationInvitation;
use App\Mail\InvestorRegistrationApprovalInvitation;

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
            ->later(self::tenSecondDelayTime(),new ProjectRegistrationRecommendationInvitation($recipient, $url));
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
            ->later(self::tenSecondDelayTime(),new ProjectRegistrationRecommendationInvitation($recipient, $url));
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
            ->later(self::tenSecondDelayTime(),new ProjectRegistrationRecommendationInvitation($recipient, $url));
    }

    /**
     * Send Director Approval Invitation
     * 
     * @param String $email 
     * @param Integer $appID
     * @param String $recipient 
     */
    public static function directorApproval($email, $appID, $recipient)
    {
        $url = self::generateURL($appID, 4);
        Mail::to([$email])
            ->later(self::tenSecondDelayTime(),new ProjectRegistrationRecommendationInvitation($recipient, $url));
    }

    /**
     * Send Success Project Registration Email notification 
     * 
     * @param String $recipient 
     * @param Integer $projectID
     * @param String $projectTitle 
     */
    public static function successProjectRegistrations($recipient, $projectID, $projectTitle)
    {
        Mail::to([$recipient-> email, $recipient-> company_email])
            ->later(self::tenSecondDelayTime(), new SuccessProjectRegistrationNotification($recipient-> name, $projectTitle, $projectID));

    }

    /**
     * Re-Notification for Project Recommendation
     * 
     * @param String $recipient
     * @param Integer $mentorRegisID
     * @param String $email 
     * @param Integer $officialEmail 
     */
    public static function reRunProjectRecommendationNotification($email, $officialEmail, $recipient, $recID, $projectTitle, $type)
    {
        $url = self::generateURL($recID, $type);
        Mail::to([$email, $officialEmail])
            ->later(self::tenSecondDelayTime(), new ReRunRecommendationNotification($recipient, $projectTitle, $url));
    } 
//////////////////////////////////////////////////////////////

    /**
     * Send successful mentor registration notification to registrant
     * @param String $recipient
     * @param Integer $mentorRegisID
     * @param String $email 
     * @param Integer $officialEmail 
     */
    public static function successMentorRegistrations($recipient, $mentorRegisID, $email, $officialEmail)
    {
        Mail::to([$email, $officialEmail])
            ->later(self::tenSecondDelayTime(), new SuccessMentorRegistrationEmailNotification($recipient, $mentorRegisID));
    } 

    /**
     * Send invitation through email to dean/head for mentor registration recommendation
     */
    public static function mrDeanHeadRecommendation($email, $recipient, $mentorName, $url)
    {
        Mail::to([$email])
            ->later(self::tenSecondDelayTime(), new MentorRegistrationRecommendationInvitation($recipient, $url, $mentorName));
    }

    /**
     * Send invitation through email to manager for mentor registration recommendation
     * @param String $email
     * @param String $companyEmail
     * @param Integer $recID
     */
    public static function mrManagerRecommendation($email, $recipient, $mentorName, $url) 
    {
        Mail::to([$email])
            ->later(self::tenSecondDelayTime(), new MentorRegistrationRecommendationInvitation($recipient, $url, $mentorName));
    }

    /**
     * Send invitation through email to director for mentor registration recommendation
     * @param String $email
     * @param String $companyEmail
     * @param Integer $recID
     */
    public static function mrDirectorApproval($email, $recipient, $mentorName, $url) 
    {
        Mail::to([$email])
            ->later(self::tenSecondDelayTime(), new MentorRegistrationApprovalInvitation($recipient, $url, $mentorName));
    }

    /**
     * Send notification throught email with information regarding NOT RECOMMENDED Mentor Registration to registrant
     * @param MentorRegis $mentorRegis
     * @param String $comment
     * @param String $email
     */
    public static function mrDeanHeadNotRecommend($mentorRegis, $comment, $reason)
    {
        Mail::to([$mentorRegis-> email, $mentorRegis-> company_email])
            ->later(self::tenSecondDelayTime(), new MentorRegistrationNotRecommendedNotification($mentorRegis-> name, $comment, $reason));

    }

    /**
     * Send notification throught email regarding SUCCESSFUL TERMINATION of the mentor registration to registrant
     */
    public static function mrTermination($recipient, $email, $officialEmail)
        
    {
        Mail::to([$email, $officialEmail])
            ->later(self::tenSecondDelayTime(), new MentorRegistrationTerminatedNotification($recipient));
    }
 ///////////////////////////////////////////////////////////////////

    /**
     * Send invitation through email to manager for investor registration recommendation
     * @param String $email
     * @param String $companyEmail
     * @param Integer $recID
     */
    public static function irManagerRecommendation($email, $recipient, $investorName, $url) 
    {
        Mail::to([$email])
            ->later(self::tenSecondDelayTime(), new InvestorRegistrationRecommendationInvitation($recipient, $url, $investorName));
    }

    /**
     * Send invitation through email to director for investor registration recommendation
     * @param String $email
     * @param String $companyEmail
     * @param Integer $recID
     */
    public static function irDirectorApproval($email, $recipient, $investorName, $url) 
    {
        Mail::to([$email])
            ->later(self::tenSecondDelayTime(), new InvestorRegistrationApprovalInvitation($recipient, $url, $investorName));
    }
 //////////////////////////////////////////////////////////////////
    /**
     * Generate URL for project registration recommendation and approval
     * 
     * @param int $recID
     * @param int $type
     */
    public static function generateURL($recID, $type)
    {
        // encrypt the recommendatiom id and type
        $cryptedRecID = Crypt::encrypt($recID);
        $cryptedType = Crypt::encrypt($type);

        // check the type and generate correct URL 
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
            default:
            // abort the request if no matched case
                abort(404);
        }
    } 

    /**
     * Get 10 second delay time to queue email
     * 
     * @return Carbon/Date
     */
    public static function tenSecondDelayTime()
    {
        return now()->addSeconds(10);
    }
}
