<?php namespace professionalweb\Paycloud\Models;

use professionalweb\Paycloud\Interfaces\Models\Product;
use professionalweb\Paycloud\Models\Product as ProductModel;
use professionalweb\Paycloud\Interfaces\Models\Payment as IPayment;

/**
 * Payment model
 * @package professionalweb\Paycloud\Models
 */
class Payment implements IPayment
{
    //<editor-fold desc="Variables">
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $orderId;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $driver;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $paymentType;

    /**
     * @var string
     */
    private $email;

    /**
     * @var array
     */
    private $extraParams = [];

    /**
     * @var array
     */
    private $products = [];

    //</editor-fold>

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? '';
        $this->driver = $data['driver'] ?? '';
        $this->status = $data['status'] ?? '';

        $this
            ->setAmount($data['amount'] ?? 0)
            ->setCurrency($data['currency'] ?? '')
            ->setEmail($data['email'] ?? '')
            ->setExtraParams($data['extra_params'] ?? [])
            ->setLocale($data['locale'] ?? '');
        $rawProducts = $this->rawData['products'] ?? [];
        foreach ($rawProducts as $productData) {
            $this->products[] = new ProductModel($productData['id'], $productData['name'], $productData['price']);
        }
    }

    /**
     * Get payment ID
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get payment amount
     *
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * Get currency ISO code
     *
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * Get payment system alias
     *
     * @return string
     */
    public function getPaymentSystem(): ?string
    {
        return $this->driver;
    }

    /**
     * Get locale. 2 digits
     *
     * @return string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * Get payment status
     *
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Get payment type
     *
     * @return string
     */
    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    /**
     * Get payer e-mail
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get extra params
     *
     * @return array
     */
    public function getExtraParams(): array
    {
        return $this->extraParams ?? [];
    }

    /**
     * Get products
     *
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products ?? [];
    }

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $paymentType
     *
     * @return $this
     */
    public function setPaymentType(string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param array $extraParams
     *
     * @return $this
     */
    public function setExtraParams(array $extraParams): self
    {
        $this->extraParams = $extraParams;

        return $this;
    }

    /**
     * @param array $products
     *
     * @return $this
     */
    public function setProducts(array $products): self
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @return string
     */
    public function getDriver(): ?string
    {
        return $this->driver;
    }

    /**
     * @return string
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }
}