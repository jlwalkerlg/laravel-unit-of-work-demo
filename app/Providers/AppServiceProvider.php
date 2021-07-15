<?php

namespace App\Providers;

use App\Services\Hashing\PasswordHasher;
use App\Services\Hashing\PasswordHasherInterface;
use App\Services\UnitOfWork;
use App\Services\UnitOfWorkInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UnitOfWorkInterface::class, UnitOfWork::class);
        $this->app->bind(PasswordHasherInterface::class, PasswordHasher::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        file_put_contents(storage_path('logs/laravel.log'), '');

        DB::listen(function ($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
    }
}
