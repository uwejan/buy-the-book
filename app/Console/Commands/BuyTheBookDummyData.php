<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BuyTheBookDummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BuyTheBookDummyData:install {--force : Do not ask for user confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the BuyTheBook Application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if ($this->option('force')) {
            $this->proceed();
        } else {
            if (
                $this->confirm(
                    'This will delete ALL your current data and install the default dummy data. Are you sure?'
                )
            ) {
                $this->proceed();
            }
        }
    }


    public function proceed()
    {
        File::deleteDirectory(public_path('storage/books'));
        $this->callSilent('storage:link');
        $copySuccess = File::copyDirectory(
            public_path('books'),
            public_path('storage/books')
        );

        if ($copySuccess) {
            $this->info('Files successfully copied to storage folder.');
        }


        $this->call('migrate:fresh', [
            //'--seed' => true,
            '--force' => true,
        ]);
        $this->info('db migrated');


        $this->call('db:seed', [
            '--force' => true,
        ]);
        $this->info('db seeded');


    }
}
