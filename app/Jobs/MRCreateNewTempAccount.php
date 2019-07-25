<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\MRTempAccount;
use App\Http\Controllers\EmailController;

class MRCreateNewTempAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $mentorRegis;
    public $registrantIC;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mentorRegis)
    {
        $this-> mentorRegis = $mentorRegis;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        $tempAccountIsExist = false;
        try {
            $tempAcc = MRTempAccount::findorfail($this-> mentorRegis-> id);
            $tempAccountIsExist = true;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $tempAccountIsExist = false;
        }

        if ($tempAccountIsExist == false) {
            MRTempAccount::createNewTempAccount($this-> mentorRegis-> id, $this-> mentorRegis-> ic);
        }elseif ($tempAccountIsExist == true){
            $tempAcc-> activate();
        }
        if ($tempAccountIsExist == true || $$tempAccountIsExist == false) {
            $status = $this-> mentorRegis-> statusTracking-> sortByDesc('created_at')-> first();
            
            if ($status-> mentor_registration_status == 1) {
                $lastestLog = $status-> deanHeadRecommendation-> deanHeadRecommendationLog-> sortByDesc('created_at')-> first();
                if ($lastestLog-> status == 2) {
                    $comment = $lastestLog-> comment;
                    $reason = $lastestLog-> reason;
                }
            }
            EmailController::mrDeanHeadNotRecommend($this-> mentorRegis, $comment, $reason);
        }
    
    }
}
