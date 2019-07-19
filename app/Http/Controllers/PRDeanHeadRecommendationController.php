<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PRDeanHeadRecommendation;

class PRDeanHeadRecommendationController extends Controller
{
    /**
     * 
     */
    public static function newRecommendation($statusID, $deanHeadID)
    {
        $deanHeadRecommendation = new PRDeanHeadRecommendation();
        $deanHeadRecommendation-> recommended_by = $deanHeadID;
        $deanHeadRecommendation-> is_recommended = null;
        $deanHeadRecommendation-> comment = null;
        $deanHeadRecommendation-> is_completed = 0;
        $deanHeadRecommendation-> pr_status_tracking_id = $statusID;
        $deanHeadRecommendation-> completed_at = null;
        $deanHeadRecommendation-> save();

        return $deanHeadRecommendation-> id;
    }
}
