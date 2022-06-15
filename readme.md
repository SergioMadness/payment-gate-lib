Библиотека для работы с paycloud.tech(https://paycloud.tech/)
====

Требования
------------

- PHP 7.1+

Установка
------------
Библиотека доступна через [composer](https://getcomposer.org/)

```
composer require professionalweb/paymentgate-lib "dev-develop"
```

Как использовать без фреймворков
-----------

```php
use professionalweb\Paycloud\Models\Product;
use professionalweb\Paycloud\Interfaces\Models\Payment;
use professionalweb\Paycloud\Services\PaycloudProtocol;
use professionalweb\Paycloud\Services\CreatePaymentService;

$protocol = new PaycloudProtocol(
    'https://paycloud.tech/',
    'токен из личного кабинете',
    'секретный ключ из личного кабинета',
    new DataSigner()
);

$paymentService = new CreatePaymentService($protocol);
$paymentUrl = $paymentService
        ->setAmount(1)
        ->setCurrency('RUB')
        ->setOrderId('your-order-id')
        ->setPaymentType(Payment::PAYMENT_TYPE_CARD)
        ->setReturnUrl('https://your-web-site.ru')
        ->setLocale('ru')
        ->setEmail('user@mail.ru')
        ->setProducts([
            new Product('ваш id продукта', 'название', 1)        
        ])
        ->getPaymentLink();

// переадресовать пользователя на $paymentUrl
```

Laravel
===

Необходимо добавить настройки. Файл _paycloud.php_.

```php
return [
    'token'  => 'generated-token-from-cp',
    'secret' => 'generated-secret-from-cp',
];
```

```php
use use professionalweb\Paycloud\Interfaces\PaycloudService;

/** @var PaycloudService $paymentService */
$paymentService = app(PaycloudService::class);
$url = $paymentService->payments()
        ->setAmount(1)
        ->setCurrency('RUB')
        ->setOrderId('your-order-id')
        ->setPaymentType(Payment::PAYMENT_TYPE_CARD)
        ->setReturnUrl('https://your-web-site.ru')
        ->setLocale('ru')
        ->setEmail('user@mail.ru')
        ->setProducts([
            new Product('ваш id продукта', 'название', 1)        
        ])
        ->getPaymentLink();

return redirect()->to($url);
```