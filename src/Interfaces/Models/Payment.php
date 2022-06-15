<?php namespace professionalweb\Paycloud\Interfaces\Models;

/**
 * Interface for payment model
 * @package professionalweb\Paycloud\Interfaces\Models
 */
interface Payment
{
    //<editor-fold desc="Constants">
    public const STATUS_PENDING = 'pending';

    public const STATUS_SUCCESS = 'success';

    public const STATUS_FAILED = 'failed';

    public const STATUS_CANCELED = 'canceled';

    public const PAYMENT_TYPE_CARD = 'card';

    public const PAYMENT_TYPE_CASH = 'cash';

    public const PAYMENT_TYPE_MOBILE = 'mobile';

    public const PAYMENT_TYPE_QIWI = 'qiwi';

    public const PAYMENT_TYPE_SBERBANK = 'sberbank';

    public const PAYMENT_TYPE_YANDEX_MONEY = 'yandex.money';
    //</editor-fold>

    /**
     * Get payment ID
     *
     * @return string
     */
    public function getId(): ?string;

    /**
     * Get payment amount
     *
     * @return float
     */
    public function getAmount(): ?float;

    /**
     * Get currency ISO code
     *
     * @return string
     */
    public function getCurrency(): ?string;

    /**
     * Get payment system alias
     *
     * @return string
     */
    public function getPaymentSystem(): ?string;

    /**
     * Get locale. 2 digits
     *
     * @return string
     */
    public function getLocale(): ?string;

    /**
     * Get payment status
     *
     * @return string
     */
    public function getStatus(): ?string;

    /**
     * Get payment type
     *
     * @return string
     */
    public function getPaymentType(): ?string;

    /**
     * Get payer e-mail
     *
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * Get extra params
     *
     * @return array
     */
    public function getExtraParams(): array;

    /**
     * Get products
     *
     * @return Product[]
     */
    public function getProducts(): array;

    /**
     * Get order id
     *
     * @return string
     */
    public function getOrderId(): ?string;
}