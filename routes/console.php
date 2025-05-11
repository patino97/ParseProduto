<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('openfoodfacts:files', function () {
    $files = Http::get(config('openfoodfacts.product.filesApi'))->body();
    
    file_put_contents('files.txt', $files);

    $this->info('Files have been saved to files.txt');
})->purpose('Get the list of files from Open Food Facts API');