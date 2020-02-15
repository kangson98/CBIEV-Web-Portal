<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programme;
class ProjectMemberController extends Controller
{
    public function getProgramme($faculty,$level){
        $selectedFaculty = '';
        $selectedLevel = '';

        // check what faculty
        switch($faculty){
            case 'R':
                $selectedFaculty = 4;
            break;
            case 'P':
                $selectedFaculty = 5;
            break;
            case 'B':
                $selectedFaculty = 17;
            break;
            case 'L':
                $selectedFaculty = 18;
            break;
            case 'V':
                $selectedFaculty = 19;
            break;
            case 'K':
                $selectedFaculty = 20;
            break;
            case 'M':
                $selectedFaculty = 21;
            break;
            case 'G':
                $selectedFaculty = 22;
            break;
            case 'J':
                $selectedFaculty = 23;
            break;
        }
        // check what level
        switch ($level) {
            case 'P':
                $selectedLevel = 1;
            break;
            case 'F':
                $selectedLevel = 2;
            break;
            case 'D':
                $selectedLevel = 3;
            break;
            case 'R':
                $selectedLevel = 4;
            break;
            case 'M':
                $selectedLevel = 5;
            break;
            case 'D':
                $selectedLevel = 6;
            break;
        }
        // get programmes from database
        // return programmes as array
        return Programme::where(array('center_faculty_id' => $selectedFaculty, 'level' => $selectedLevel))->pluck('programme_name');
        // return Programme::where(array('center_faculty_id' => $selectedFaculty, 'level' => $selectedLevel))->get();
    }

}
