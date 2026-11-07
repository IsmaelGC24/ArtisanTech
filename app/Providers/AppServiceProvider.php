<?php

namespace App\Providers;

use App\Interfaces\PaymentMethod;
use App\Util\CardPayment;
use App\Util\CashOnDeliveryPayment;
use App\Util\MedellinWeather;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        View::composer('layouts.app', function ($view) {
            $view->with('weather', app(MedellinWeather::class)->getCurrent());
        });
    }
}
