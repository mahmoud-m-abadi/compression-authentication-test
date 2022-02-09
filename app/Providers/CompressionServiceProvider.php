<?php

namespace App\Providers;

use App\Services\CompressionService;
use Illuminate\Support\ServiceProvider;

class CompressionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CompressionService::class, function ($app) {
            return new CompressionService(
                config('compression.fileType'),
                config('compression.filePath'),
                config('compression.fileName'),
                config('compression.fileToCompress'),
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
