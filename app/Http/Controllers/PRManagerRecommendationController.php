<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CBIEVStaff;
use App\PRManagerRecommendation;

class PRManagerRecommendationController extends Controller
{
    /**
     * 
     */
    public static function newRecommendation($statusID, $managerID)
    {
        $managerRecommendation = new PRmanagerRecommendation();
        $managerRecommendation-> recommended_by = $managerID;
        $managerRecommendation-> is_recommended = null;
        $managerRecommendation-> comment = null;
        $managerRecommendation-> is_completed = 0;
        $managerRecommendation-> pr_status_tracking_id = $statusID;
        $managerRecommendation-> completed_at = null;
        $managerRecommendation-> save();

        return $managerRecommendation-> id;
    }
}
