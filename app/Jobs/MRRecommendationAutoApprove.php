<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\MentorRegistrationStatusTracking;
use App\MRDeanHeadRecommendationLog;
use App\Http\Controllers\MentorRegistrationStatusTrackingController;

class MRRecommendationAutoApprove implements ShouldQueue
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
        $mrst = MentorRegistrationStatusTracking::find($this->statusID);
        if ($mrst-> mentor_registration_status == 1) {
                $rec = $mrst-> deanHeadRecommendation;
                $log = $rec-> deanHeadRecommendationLog-> sortByDesc('created_at')-> first();
                    if ($log-> status == 0) {
                        $this-> autoApprove = true;
                    }else{
                        $this-> autoApprove = false;
                }
        }

        if ($this-> autoApprove == true) {
            $rec-> update([
                'is_recommended' => 1
            ]);

            MRDeanHeadRecommendationLog::createNewAutoApprovedLog($rec-> id);

            MentorRegistrationStatusTrackingController::startManagerRecommendation($mrst-> mentorRegistration);
        }
    }
}
