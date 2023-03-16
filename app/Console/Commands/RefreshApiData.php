<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DataController;

class RefreshApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forces a refresh of the API data the next time the Laravel endpoint is called';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dataController = new DataController();
        $dataController->refreshAPIData();
        $this->info('API data has been flagged for refresh.');
    }
}
