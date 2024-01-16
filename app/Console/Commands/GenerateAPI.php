<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate API for the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // generate API (random string of 64) and update .env file
        $key = bin2hex(random_bytes(32));

        // update .env file
        file_put_contents(
            $this->laravel->environmentFilePath(),
            str_replace(
                'APP_KEY=' . env('APP_KEY'),
                'APP_KEY=' . $key,
                file_get_contents($this->laravel->environmentFilePath())
            )
        );

        $this->info('API generated successfully.');
        // show the api key
        $this->info('API: ' . $key);

        return Command::SUCCESS;
    }
}
