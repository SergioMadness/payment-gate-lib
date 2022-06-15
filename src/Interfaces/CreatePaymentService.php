<?php namespace professionalweb\Paycloud\Interfaces;

use professionalweb\Paycloud\Interfaces\Models\Payment;
use professionalweb\Paycloud\Interfaces\Models\Product;

/**
 * Interface for service to create payments
 * @package professionalweb\Paycloud\Interfaces
 */
interface CreatePaymentService
{
    /**
     * Set payment amount
     *
     * @param float $amount
     *
     * @return CreatePaymentService
     */
    public function setAmount(float $amount): self;

    /**
     * Set order id
     *
     * @param string $orderId
     *
     * @return CreatePaymentService
     */
    public function setOrderId(string $orderId): self;

    /**
     * Set payment type
     *
     * @param string $paymentType
     *
     * @return CreatePaymentService
     */
    public function setPaymentType(string $paymentType): self;

    /**
     * Set url user would be returned to after payment completed
     *
     * @param string $url
     *
     * @return CreatePaymentService
     */
    public function setReturnUrl(string $url): self;

    /**
     * Set payment interface locale
     *
     * @param string $locale
     *
     * @return CreatePaymentService
     */
    public function setLocale(string $locale): self;

    /**
     * Set payer email
     *
     * @param string $email
     *
     * @return CreatePaymentService
     */
    public function setEmail(string $email): self;

    /**
     * Set payer IP
     *
     * @param string $ip
     *
     * @return CreatePaymentService
     */
    public function setIp(string $ip): self;

    /**
     * Set product list
     *
     * @param array $products
     *
     * @return CreatePaymentService
     */
    public function setProducts(array $products): self;

    /**
     * Add single product
     *
     * @param string $id
     * @param string $name
     * @param float  $price
     *
     * @return CreatePaymentService
     */
    public function addProduct(string $id, string $name, float $price): self;

    /**
     * Add product object
     *
     * @param Product $product
     *
     * @return CreatePaymentService
     */
    public function pushProduct(Product $product): self;

    /**
     * Set extra params
     *
     * @param array $params
     *
     * @return CreatePaymentService
     */
    public function setExtraParams(array $params): self;

    /**
     * Get url to payment
     *
     * @return string
     */
    public function getPaymentLink(): string;

    /**
     * Just save payment
     *
     * @return Payment
     */
    public function save(): Payment;

    /**
     * Set payment currency
     *
     * @param string $currency
     *
     * @return CreatePaymentService
     */
    public function setCurrency(string $currency): self;
}