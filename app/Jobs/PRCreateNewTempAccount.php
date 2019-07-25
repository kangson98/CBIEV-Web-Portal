<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Hash;
use App\PRTempAccount;
use App\Mail\ProjectRegistrationNotRecommendedNotification;
use Illuminate\Support\Facades\Mail;

class PRCreateNewTempAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $projectRegis;
    public $leader;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($projectRegis)
    {
        $this-> projectRegis = $projectRegis;
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
            $tempAcc = PRTempAccount::findorfail($this-> projectRegis-> id);
            $tempAccountIsExist = true;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $tempAccountIsExist = false;
        }

        $this-> leader = $this-> projectRegis-> leader;
        if ($tempAccountIsExist == false) {

            $newTempAcc = new PRTempAccount();
            $newTempAcc-> project_registration_id = $this-> projectRegis-> id;
            $newTempAcc-> login_id = 'P000' . $this-> projectRegis-> id;
            $newTempAcc-> password = Hash::make($this-> leader-> ic);
            $newTempAcc-> save();

        }elseif ($tempAccountIsExist == true){
            $tempAcc-> activate();
        }

        Mail::to([$this-> leader-> email, $this-> leader-> company_email])->send(new ProjectRegistrationNotRecommendedNotification($this-> projectRegis-> title, $this-> leader-> name));
    
    }
}
