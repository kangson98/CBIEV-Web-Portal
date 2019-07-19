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
    public static function newRecommendation($statusID)
    {
        $managerRecommendation = new PRManagerRecommendation();
        $managerRecommendation-> recommended_by = CBIEVStaff::where('role', 2)-> get()-> first()-> id;
        $managerRecommendation-> is_recommended = null;
        $managerRecommendation-> comment = null;
        $managerRecommendation-> is_completed = 0;
        $managerRecommendation-> pr_status_tracking_id = $statusID;
        $managerRecommendation-> completed_at = null;
        $managerRecommendation-> save();

        return $managerRecommendation-> id;
    }
}
