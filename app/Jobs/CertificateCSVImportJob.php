<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

class CertificateCSVImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $path
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        $fileHandle = fopen(Storage::path($this->path), "r");
        
        $jobs = [];

        $counter = 0;

        while(!feof($fileHandle)) {

            $line = fgetcsv($fileHandle, 0, ";");

            if($counter == 0) {
                $counter++;
                continue;
            }

            if(!$line) {
                continue;
            }

            //deal with cedilla in the array
            $line = array_map(function($item) {
                return mb_convert_encoding($item, "UTF-8", "ISO-8859-1");
            }, $line);

            $jobs[] = new ProcessCertificateCSVLineJob($line);

        }

        fclose($fileHandle);

        Bus::batch($jobs)
            ->name('certificate - '. date('Y-m-d H:i:s'))
            ->onQueue('csv')
            ->allowFailures()
            ->dispatch();
    }
}
