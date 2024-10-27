<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CartDetail;
use App\Observers\CartDetailObserver;
use App\Models\Order;
use App\Observers\OrderObserver;

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
        CartDetail::observe(CartDetailObserver::class);
        Order::observe(OrderObserver::class);
    }
}
