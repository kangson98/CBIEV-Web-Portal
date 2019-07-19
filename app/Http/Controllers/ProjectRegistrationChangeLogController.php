<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectRegistrationChangeLog;

class ProjectRegistrationChangeLogController extends Controller
{
    public static function newLog($prID, $newPR, $oldPR)
    {
        if (strcasecmp ($newPR-> problem_statement, $oldPR-> problem_statement) != 0) {
            self::createNewLog($prID, 'problem_statement', $newPR-> problem_statement, $oldPR-> problem_statement);
        }
        if (strcasecmp ($newPR-> product_solution, $oldPR-> product_solution) != 0) {
            self::createNewLog($prID, 'product_solution', $newPR-> product_solution, $oldPR-> product_solution);

        }
        if (strcasecmp ($newPR-> target_market, $oldPR-> target_market) != 0) {
            self::createNewLog($prID, 'target_market', $newPR-> target_market, $oldPR-> target_market);
        }
    }

    public static function createNewLog($prID, $column, $newValue, $oldValue)
    {
        $prLog = new ProjectRegistrationChangeLog();
        $prLog-> project_registration_id = $prID;
        $prLog-> column_name = $column;
        $prLog-> old_value =  $oldValue;
        $prLog-> new_value = $newValue;
        $prLog-> save();
    }
}
