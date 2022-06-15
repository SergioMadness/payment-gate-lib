<?php namespace professionalweb\Paycloud\Services;

use professionalweb\Paycloud\Interfaces\Protocol;
use professionalweb\Paycloud\Interfaces\Models\Payment;
use professionalweb\Paycloud\Interfaces\Models\Product;
use professionalweb\Paycloud\Models\Product as ProductModel;
use professionalweb\Paycloud\Models\Payment as PaymentModel;
use professionalweb\Paycloud\Interfaces\CreatePaymentService as ICreatePaymentService;

/**
 * Service to create payments
 * @package professionalweb\Paycloud\Services
 */
class CreatePaymentService implements ICreatePaymentService
{
    public const URL_GET_LINK = '/api/v1/payment';

    /**
     * @var \professionalweb\Paycloud\Models\Payment
     */
    private $payment;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var Protocol
     */
    private $protocol;

    public function __construct(Protocol $protocol)
    {
        $this->setProtocol($protocol);
        $this->newPayment();
    }

    /**
     * Create new payment
     *
     * @return CreatePaymentService
     */
    public function newPayment(): self
    {
        $this->payment = new PaymentModel();

        return $this;
    }

    /**
     * Set payment amount
     *
     * @param float $amount
     *
     * @return ICreatePaymentService
     */
    public function setAmount(float $amount): ICreatePaymentService
    {
        $this->payment->setAmount($amount);

        return $this;
    }

    /**
     * Set order id
     *
     * @param string $orderId
     *
     * @return ICreatePaymentService
     */
    public function setOrderId(string $orderId): ICreatePaymentService
    {
        $this->payment->setOrderId($orderId);

        return $this;
    }

    /**
     * Set payment type
     *
     * @param string $paymentType
     *
     * @return ICreatePaymentService
     */
    public function setPaymentType(string $paymentType): ICreatePaymentService
    {
        $this->payment->setPaymentType($paymentType);

        return $this;
    }

    /**
     * Set url user would be returned to after payment completed
     *
     * @param string $url
     *
     * @return ICreatePaymentService
     */
    public function setReturnUrl(string $url): ICreatePaymentService
    {
        $this->returnUrl = $url;

        return $this;
    }

    /**
     * Get return url
     *
     * @return string
     */
    public function getReturnUrl(): ?string
    {
        return $this->returnUrl;
    }

    /**
     * Set payment interface locale
     *
     * @param string $locale
     *
     * @return ICreatePaymentService
     */
    public function setLocale(string $locale): ICreatePaymentService
    {
        $this->payment->setLocale($locale);

        return $this;
    }

    /**
     * Set payer email
     *
     * @param string $email
     *
     * @return ICreatePaymentService
     */
    public function setEmail(string $email): ICreatePaymentService
    {
        $this->payment->setEmail($email);

        return $this;
    }

    /**
     * Set payer IP
     *
     * @param string $ip
     *
     * @return ICreatePaymentService
     */
    public function setIp(string $ip): ICreatePaymentService
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * Set product list
     *
     * @param array $products
     *
     * @return ICreatePaymentService
     */
    public function setProducts(array $products): ICreatePaymentService
    {
        $this->payment->setProducts($products);

        return $this;
    }

    /**
     * Add single product
     *
     * @param string $id
     * @param string $name
     * @param float  $price
     *
     * @return ICreatePaymentService
     */
    public function addProduct(string $id, string $name, float $price): ICreatePaymentService
    {
        return $this->pushProduct(new ProductModel($id, $name, $price));
    }

    /**
     * Add product object
     *
     * @param Product $product
     *
     * @return ICreatePaymentService
     */
    public function pushProduct(Product $product): ICreatePaymentService
    {
        $products = $this->payment->getProducts();
        $products[] = $product;
        $this->payment->setProducts($products);

        return $this;
    }

    /**
     * Set extra params
     *
     * @param array $params
     *
     * @return ICreatePaymentService
     */
    public function setExtraParams(array $params): ICreatePaymentService
    {
        $this->payment->setExtraParams($params);

        return $this;
    }

    /**
     * Get url to payment
     *
     * @return string
     */
    public function getPaymentLink(): string
    {
        $data = [
            'amount'       => $this->payment->getAmount(),
            'currency'     => $this->payment->getCurrency(),
            'order_id'     => $this->payment->getOrderId(),
            'payment_type' => $this->payment->getPaymentType(),
            'extra_params' => $this->payment->getExtraParams(),
            'email'        => $this->payment->getEmail(),
            'ip'           => $this->getIp(),
            'locale'       => $this->payment->getLocale(),
            'products'     => $this->payment->getProducts(),
        ];
        if (!empty($returnUrl = $this->getReturnUrl())) {
            $data['return_url'] = $returnUrl;
        }

        return $this->getProtocol()->execute(self::URL_GET_LINK, $data)['redirect'];
    }

    /**
     * Just save payment
     *
     * @return Payment
     */
    public function save(): Payment
    {
        // TODO: Implement save() method.
    }

    /**
     * @return Protocol
     */
    public function getProtocol(): Protocol
    {
        return $this->protocol;
    }

    /**
     * @param Protocol $protocol
     *
     * @return $this
     */
    public function setProtocol(Protocol $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Set payment currency
     *
     * @param string $currency
     *
     * @return ICreatePaymentService
     */
    public function setCurrency(string $currency): ICreatePaymentService
    {
        $this->payment->setCurrency($currency);

        return $this;
    }
}