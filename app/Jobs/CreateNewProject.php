<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Http\Controllers\ISparkProjectController;

class CreateNewProject implements ShouldQueue
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
        $this-> prID= $prID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ISparkProjectController::createNewProject($this-> prID);

    }
}
