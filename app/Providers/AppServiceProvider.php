<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\NotifikasiModel;
use Illuminate\Support\Facades\Auth;

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
        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }

        View::composer('*', function ($view) {
            $notifikasi = collect();
            if (Auth::check()) {
                $notifikasi = NotifikasiModel::where('user_id', Auth::id())
                    ->where('status', 1)
                    ->latest()
                    ->take(3) // ambil 5 notif terbaru
                    ->get();
            }

            $view->with('notifikasi_global', $notifikasi);
        });
    }
}
