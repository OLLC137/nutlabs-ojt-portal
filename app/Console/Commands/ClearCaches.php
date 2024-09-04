<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ClearCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all types of caches';

    public function handle()
    {
        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, 4);

        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %message%');
        $progressBar->setMessage('Clearing caches...');

        $progressBar->start();

        $this->call('route:clear');
        $progressBar->advance();

        $this->call('config:clear');
        $progressBar->advance();

        $this->call('view:clear');
        $progressBar->advance();

        $this->call('cache:clear');
        $progressBar->advance();

        $progressBar->finish();

        $this->info("\nAll caches have been cleared.");
    }
}
