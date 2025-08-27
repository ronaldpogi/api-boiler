<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);

        Response::macro('success', function ($data = null, $message = 'Success', $status = 200) {
            return Response::json([
                'status'  => 'success',
                'message' => $message,
                'data'    => $data,
            ], $status);
        });

        Response::macro('error', function ($message = 'Error', $errors = [], $status = 400) {
            return Response::json([
                'status'  => 'error',
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });
    }
}


