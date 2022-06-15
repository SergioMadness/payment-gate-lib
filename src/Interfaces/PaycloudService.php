<?php namespace professionalweb\Paycloud\Interfaces;

/**
 * Interface for main service to work with paycloud
 * @package professionalweb\Paycloud\Interfaces
 */
interface PaycloudService
{
    /**
     * Create payment service to work with payments
     *
     * @return CreatePaymentService
     */
    public function payments(): CreatePaymentService;
}