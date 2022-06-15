<?php namespace professionalweb\Paycloud\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\Paycloud\Interfaces\Protocol;
use professionalweb\Paycloud\Interfaces\DataSigner;
use professionalweb\Paycloud\Services\PaycloudService;
use professionalweb\Paycloud\Services\PaycloudProtocol;
use professionalweb\Paycloud\Services\DataSignersService;
use professionalweb\Paycloud\Services\CreatePaymentService;
use professionalweb\Paycloud\Interfaces\PaycloudService as IPaycloudService;
use professionalweb\Paycloud\Interfaces\CreatePaymentService as ICreatePaymentService;

class PaycloudProvider extends ServiceProvider
{
    public function boot(): void
    {

    }

    public function register(): void
    {
        $this->app->bind(DataSigner::class, DataSignersService::class);
        $this->app->bind(IPaycloudService::class, PaycloudService::class);
        $this->app->bind(ICreatePaymentService::class, CreatePaymentService::class);
        $this->app->bind(Protocol::class, function ($app) {
            return new PaycloudProtocol(
                config('paycloud.url', 'https://paycloud.tech/'),
                config('paycloud.token', ''),
                config('paycloud.secret', ''),
                app(DataSigner::class)
            );
        });
    }
}