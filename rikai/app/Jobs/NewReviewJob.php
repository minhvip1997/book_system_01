<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiveReview;
use App\Models\Review;
use App\Models\User;

class NewReviewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $review;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Review $review)
    {
        //
        $this->review = $review;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::newReview($this->review)->get();
            foreach ($users as $user) {
                $email = new ReceiveReview($this->review);
                Mail::to($user->email)->queue($email);
            }
        return $this->release(2);
    }
}
