<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\PRManagerRecommendation;
use App\PRDirectorApproval;

class SaveURLProjectRecommendationApproval implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $type;
    protected $url;
    protected $recID;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $type, $recID)
    {
        $this-> type = $type;
        $this-> url = $url;
        $this-> recID = $recID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this-> type) {
            case 1:
                $prM = PRManagerRecommendation::find($this-> recID);
                $prM-> url = $this-> url();
                $prM-> save();
                break;
            case 2:
                $prM = PRDirectorApproval::find($this-> recID);
                $prM-> url = $this-> url();
                $prM-> save();
                break;
        }
    }
}
