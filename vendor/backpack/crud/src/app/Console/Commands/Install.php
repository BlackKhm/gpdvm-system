<?php

namespace Backpack\CRUD\app\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    use Traits\PrettyCommandOutput;

    protected $progressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:install
                                {--timeout=300} : How many seconds to allow each process to run.
                                {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Backpack requirements on dev, publish files and create uploads directory.';

    /**
     * Execute the console command.
     *
     * @return mixed Command-line output
     */
    public function handle()
    {
        $this->progressBar = $this->output->createProgressBar(5);
        $this->progressBar->minSecondsBetweenRedraws(0);
        $this->progressBar->maxSecondsBetweenRedraws(120);
        $this->progressBar->setRedrawFrequency(1);

        $this->progressBar->start();

        $this->info(' Backpack installation started. Please wait...');
        $this->progressBar->advance();

        $this->line(' Publishing configs, views, js and css files');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => 'Backpack\CRUD\BackpackServiceProvider',
            '--tag' => 'minimum',
        ]);

        $this->line(" Creating users table (using Laravel's default migration)");
        $this->executeArtisanProcess('migrate', $this->option('no-interaction') ? ['--no-interaction' => true] : []);

        $this->line(" Creating App\Http\Middleware\CheckIfAdmin.php");
        $this->executeArtisanProcess('backpack:publish-middleware');

        $this->progressBar->finish();
        $this->info(' Backpack installation finished.');

        // DevTools
        $this->box('Did you know about Backpack DevTools?');
        $this->note('DevTools adds a dead-simple web interface to easily generate Models, Migrations, Seeders, Factories, CRUDs, etc.');
        $this->note('But it\'s a paid tool. For more info, payment and access, please visit https://backpackforlaravel.com/products/devtools');

        if ($this->confirm('Would you like to install Backpack DevTools?', false)) {
            $this->call('backpack:require:devtools');
        }
    }
}
