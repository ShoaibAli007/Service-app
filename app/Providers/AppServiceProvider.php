<?php

namespace App\Providers;

use App\Interfaces\EmailInterface;
use App\Interfaces\ServiceInterface;
use App\Repository\EmailRepository;
use App\Repository\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailInterface::class,EmailRepository::class);
        $this->app->bind(ServiceInterface::class,ServiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
