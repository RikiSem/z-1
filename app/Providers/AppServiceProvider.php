<?php

namespace App\Providers;

use App\Http\Classes\Services\EmployeeService;
use App\Http\Classes\Services\TransactionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeService::class, function ($app) {
            return new EmployeeService();
        });
        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
