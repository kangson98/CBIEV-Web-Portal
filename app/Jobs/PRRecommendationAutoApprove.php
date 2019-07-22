<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\ProjectRegistrationStatusTracking;
use App\Http\Controllers\ProjectRegistrationStatusTrackingController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class PRRecommendationAutoApprove implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $statusID;

    protected $autoApprove = false;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($statusID)
    {
        $this-> statusID = $statusID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $prst = new ProjectRegistrationStatusTrackingController;
        $status = ProjectRegistrationStatusTracking::find($this-> statusID);
        switch ($status-> project_registration_status) {
            case 1:
                foreach ($status-> supervisorRecommendation as $rec) {
                    if($rec-> is_completed === 0)
                    {
                        $rec-> is_completed = 3;
                        $rec-> is_recommended = true;
                        $rec-> completed_at = Carbon::now();
                        $rec-> save();
                        
                        $this-> autoApprove = true;
                    }
                }
                if ($this-> autoApprove == true) {
                    $prst-> startDeanHeadRecommendation($status-> project_registration_id);
                }
                break;
            case 2:
                foreach ($status-> deanHeadRecommendation as $rec) {
                    if($rec-> is_completed === 0)
                    {
                        $rec-> is_completed = 3;
                        $rec-> is_recommended = true;
                        $rec-> completed_at = Carbon::now();
                        $rec-> save();

                        $this-> autoApprove = true;
                    }
                }
                if($this-> autoApprove == true)
                {
                    $prst-> startManagerRecommendation($status-> project_registration_id);
                }
                break;
            case 3:
                foreach ($status-> managerRecommendation as $rec) {
                    if($rec-> is_completed === 0)
                    {
                        $rec-> is_completed = 3;
                        $rec-> is_recommended = true;
                        $rec-> completed_at = Carbon::now();
                        $rec-> save();

                        $this-> autoApprove = true;
                    }
                }

                if($this-> autoApprove == true)
                {
                    $prst-> startDirectorApproval($status-> project_registration_id);
                }
                break;
        }
    }
}
