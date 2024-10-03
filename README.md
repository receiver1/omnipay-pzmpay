# Omnipay: PZMPay
Поддержка эквайринга PZMPay для Omnipay 

[![Total Downloads](https://img.shields.io/packagist/dt/cardgate/omnipay-cardgate.svg)](https://packagist.org/packages/cardgate/omnipay-cardgate)
[![Latest Version](https://img.shields.io/packagist/v/cardgate/omnipay-cardgate.svg)](https://github.com/cardgate/omnipay-cardgate/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## Установка

```bash
composer require league/omnipay receiver1/omnipay-tinkoff
```


## Использование 
```php
// Создаём новый платёжный шлюз
$gateway = Omnipay::create('PZMPay');

// Устанавливаем "секретный код"
$gateway->setSecretCode('secretCode');

// Создаём новый платёж на сумму 10 руб. 00 коп.
$request = $gateway->purchase([
  'amount' => 10,
  'currency' => 'RUB',
  'description' => 'Пополнение баланса 1337 Cheats',
]);

$response = $request->send();

if (!$response->isSuccessful()) {
  throw new Exception($response->getMessage());
}

// Получаем идентификатор платежа в PZMPay
$invoiceId = $response->getTransactionId();

// Получаем ссылку на форму оплаты в PZMPay
$redirectUrl = response->getRedirectUrl();
```