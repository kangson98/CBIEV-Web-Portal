<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MentorRegistrationChangeLog;

class MentorRegistrationChangeLogController extends Controller
{
    public static function newLog($mrID, $newExp, $oldExp)
    {
        $newExpArray = $newExp->attributesToArray();
        $arrayKey = array_key($newExpArray);
        for ($i=0; $i < count($newExpArray); $i++) { 
            if (strcasecmp ($newExp[$i], $oldExp[$i]) != 0) {
                self::createNewLog($mrID, $arrayKey[$i], $newExp[$i], $oldExp[$i]);
            }
        }
    }

    public static function createNewLog($mrID, $column, $newValue, $oldValue)
    {
        MentorRegistrationChangeLog::createNewLog($mrID, $column, $newValue, $oldValue);

    }
}
