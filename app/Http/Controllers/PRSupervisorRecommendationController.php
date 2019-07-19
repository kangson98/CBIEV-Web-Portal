<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PRSupervisorRecommendation;

class PRSupervisorRecommendationController extends Controller
{
    /**
     * 
     */
    public static function newRecommendation($statusID, $supervisorID)
    {
        $supervisorRecommendation = new PRSupervisorRecommendation();
        $supervisorRecommendation-> recommended_by = $supervisorID;
        $supervisorRecommendation-> is_recommended = null;
        $supervisorRecommendation-> comment = null;
        $supervisorRecommendation-> is_completed = 0;
        $supervisorRecommendation-> pr_status_tracking_id = $statusID;
        $supervisorRecommendation-> completed_at = null;
        $supervisorRecommendation-> save();

        return $supervisorRecommendation-> id;
    }
}
