<?php

namespace Intraset\LaravelFilter;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFilter::class,
            ]);
        }
    }
}
