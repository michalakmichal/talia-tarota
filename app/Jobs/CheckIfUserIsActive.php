<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Carbon\Carbon;

class CheckIfUserIsActive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    public $timeout = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
       
        //Carbon::parse(Carbon::now())->diffInDays($dataToCompare);
        //if(Carbon::Now()->addSeconds(90)->lessThan($this->user->last_seen))

        $this->user->activity_checked = true; // user's activity is being checked
        $this->user->activity_state_id = 1; //user is online
        $this->user->save();
        //check if user sent any activity timestamp since 2min
        while(($diff = Carbon::parse(Carbon::now())->diffInSeconds($this->user->last_seen)) < 120)
        {
            echo $diff.'\n';
            sleep(10);
            $this->user->refresh();
        }
        $this->user->activity_checked = false;
        $this->user->activity_state_id = 2;
        $this->user->save();

       // else $this->user->activity_state_id = 2;
    }
}
