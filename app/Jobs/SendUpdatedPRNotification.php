<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Http\Controllers\EmailController;
use App\ProjectRegistration;

class SendUpdatedPRNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $prID;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($prID)
    {
        $this-> prID = $prID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $projectRegis = ProjectRegistration::find($this-> prID);
        $status = $projectRegis-> statusTrackingLatest();
        switch ($status-> project_registration_status) {
            case 7:
                foreach ($status-> supervisorRecommendation as $rec) {
                    $supervisor = $rec-> prSupervisor;
                    EmailController::reRunProjectRecommendationNotification($supervisor-> email, $supervisor-> company_email, $supervisor-> name, $rec-> id, $projectRegis-> project_title, 1);
                }
                break;
            case 8:
                foreach ($status-> deanHeadRecommendation as $rec) {
                    $deanHead = $rec-> deanHead;
                    EmailController::reRunProjectRecommendationNotification(null, $deanHead-> email, $deanHead-> name, $rec-> id, $projectRegis-> project_title, 2);
                }
                break;
            case 9:
                foreach ($status-> managerRecommendation as $rec) {
                    $manager = $rec-> manager;
                    EmailController::reRunProjectRecommendationNotification(null, $manager-> email, $manager-> name, $rec-> id, $projectRegis-> project_title, 3);
                }
                break;
        }
    }
}
