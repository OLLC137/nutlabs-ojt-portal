<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class RefreshDatabase extends Command
{
    protected $signature = 'refresh:db';
    protected $description = 'Wipe the database, run migrations, and seed the database';

    public function handle()
    {
        if ($this->confirm('This action will wipe your database, run migrations, and seed it. Are you sure you want to continue?')) {
            $output = new ConsoleOutput();
            $progressBar = new ProgressBar($output, 3);

            $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %message%');
            $progressBar->setMessage('Refreshing database...');

            $progressBar->start();

            $this->info('Wiping the database...');
            Artisan::call('db:wipe');
            $progressBar->advance();

            $this->info('Running migrations...');
            Artisan::call('migrate');
            $progressBar->advance();

            $this->info('Seeding the database...');
            Artisan::call('db:seed');
            $progressBar->advance();

            $progressBar->finish();

            $this->info("\nDatabase refresh completed successfully.");
        } else {
            $this->info('Database refresh aborted.');
        }
    }
}
