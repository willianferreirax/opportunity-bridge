<?php

namespace App\Jobs;

use App\Models\Certificate;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\LeadDistributionProspect;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessCertificateCSVLineJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected array $line
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if(!$this->line) {
            return;
        }

        $alreadyExists = Certificate::where('hash', $this->line[0])->first();

        if($alreadyExists) {
            return;
        }

        Certificate::create([
            'hash' => $this->line[0],
        ]);

    }
}
