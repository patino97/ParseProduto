<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Console\Commands\CommandUpdateProducts;

class OpenFoofFacts implements ShouldQueue
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command runs once a day to update product files';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $updateProducts = new CommandUpdateProducts();
        $updateProducts->updateData();
    }
}
