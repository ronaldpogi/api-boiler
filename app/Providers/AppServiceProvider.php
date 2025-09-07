<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Response;
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

        Response::macro('success', function ($data = [], $message = null, $status = 200) {
            // fallback default message from lang file
            $defaultMessage = $message ?? __('messages.success');

            return response()->json([
                'status'  => true,
                'message' => $defaultMessage,
                'data'    => $data,
            ], $status);
        });

        Response::macro('error', function ($message = null, $status = 400, $errors = []) {
            $defaultMessage = $message ?? __('messages.error');

            return response()->json([
                'status'  => false,
                'message' => $defaultMessage,
                'errors'  => $errors,
            ], $status);
        });
    }
}


