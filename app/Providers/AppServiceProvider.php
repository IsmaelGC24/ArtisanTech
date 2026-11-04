<?php

namespace App\Providers;

use App\Interfaces\PaymentMethod;
use App\Util\CardPayment;
use App\Util\CashOnDeliveryPayment;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentMethod::class, function ($app) {
            if (request()->get('payment_method') === 'cash') {
                return new CashOnDeliveryPayment;
            } else {
                return new CardPayment;
            }
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
