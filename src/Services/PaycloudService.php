<?php namespace professionalweb\Paycloud\Services;

use professionalweb\Paycloud\Interfaces\CreatePaymentService;
use professionalweb\Paycloud\Interfaces\PaycloudService as IPaycloudService;

/**
 * Service to work with paycloud API
 * @package professionalweb\Paycloud\Services
 */
class PaycloudService implements IPaycloudService
{

    /**
     * Create payment service to work with payments
     *
     * @return CreatePaymentService
     */
    public function payments(): CreatePaymentService
    {
        return app(CreatePaymentService::class);
    }
}