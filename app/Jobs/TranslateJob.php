<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Job;

class TranslateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Job $jobListing)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger('Translating job listing: ' . $this->jobListing->title . ' to Spanish.');

        // maybe you want to use a translation service here with an AI class e.g.
        // AI::translate($this->jobListing->description, 'es');

        // the point is, this is potentially a long running task that should be queued and not make the user wait for it to finish

        // note: always restart your worker if a change is made to the job class
    }
}
