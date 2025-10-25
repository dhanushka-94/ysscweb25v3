<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MemberApplication;

class UpdateApplicationReferenceNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-application-reference-numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing member applications with reference numbers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating application reference numbers...');
        
        $applications = MemberApplication::whereNull('reference_number')
            ->orWhere('reference_number', '')
            ->orderBy('created_at', 'asc')
            ->get();
        
        $currentYear = date('Y');
        $counter = 1;
        
        foreach ($applications as $application) {
            $referenceNumber = 'YSSC/' . $currentYear . '/' . str_pad($counter, 4, '0', STR_PAD_LEFT);
            $application->update(['reference_number' => $referenceNumber]);
            $this->line("Updated application ID {$application->id} with reference: {$referenceNumber}");
            $counter++;
        }
        
        $this->info("Updated {$applications->count()} applications with reference numbers.");
    }
}
