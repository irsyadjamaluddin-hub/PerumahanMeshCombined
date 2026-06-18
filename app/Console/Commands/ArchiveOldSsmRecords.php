<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SSM; // <- Make sure this matches your model name
use Carbon\Carbon;

class ArchiveOldSsmRecords extends Command
{
    protected $signature = 'ssm:archive-old';
    protected $description = 'Archive SSM records that are selesai and older than 1 month';

    public function handle()
    {
        $count = SSM::where('status_ssm', 'selesai')
            ->where('created_at', '<', Carbon::now()->subMonth())
            ->where('is_archived', false)
            ->update(['is_archived' => true]);

        $this->info("Archived {$count} SSM records.");
    }
}
