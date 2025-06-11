<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Process;

class BuildIurisprudentia implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 60;

    public function handle(): void
    {
        $frontendPath = config('iurisprudentia.path').'/frontend';

        $result = Process::path($frontendPath)
            ->run('npm run build');

        if ($result->failed()) {
            throw new \Exception('Build failed: '.$result->errorOutput());
        }
    }

    public function uniqueId(): string
    {
        return 'iurisprudentia-build';
    }
}
