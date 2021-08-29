<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\TagService;
use App\Library\Services\Contracts\TagServiceInterface;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TagServiceInterface::class,TagService::class);
    }
}
