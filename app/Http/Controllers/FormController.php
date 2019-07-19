<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programme;

class FormController extends Controller
{
    /**
     * Get list of programe for selected department and level for participant in project registration
     */
    public function getProgramme($department, $level){
        switch ($level) {
            case 'A Level':
                $level = '1';
                break;
            case 'Foundation':
                $level = '2';
                break;
            case 'Diploma':
                $level = '3';
                break;
            case 'Degree':
                $level = '4';
                break;
            case 'Master':
                $level = '5';
                break;
            case 'Doctorate':
                $level = '6';
                break;
            default:
                $level = 'None';
                break;
        }
        switch ($department) {
            case 'FAFB':
                $department = 1;
                break;
            case 'FOAS':
                $department = 2;
                break;
            case 'FOCS':
                $department = 3;
                break;
            case 'FOBE':
                $department = 4;
                break;
            case 'FOET':
                $department = 5;
                break;
            case 'FCCI':
                $department = 6;
                break;
            case 'FSSH':
                $department = 7;
                break;
            case 'CPUS':
                $department = 8;
                break;
            case 'CPSR':
                $department = 9;
                break;
            
            default:
                # code...
                break;
        }
        $selectedProgramme = Programme::where('faculty_center_id', $department)
        ->where('level', $level)
        ->where('is_active', 1)
        ->orderBy('programme_name', 'asc')
        ->pluck('programme_name');

        return $selectedProgramme;
    }
}
