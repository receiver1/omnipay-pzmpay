# Omnipay: PZMPay
Поддержка эквайринга PZMPay для Omnipay 

[![Total Downloads](https://img.shields.io/packagist/dt/cardgate/omnipay-cardgate.svg)](https://packagist.org/packages/cardgate/omnipay-cardgate)
[![Latest Version](https://img.shields.io/packagist/v/cardgate/omnipay-cardgate.svg)](https://github.com/cardgate/omnipay-cardgate/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## Установка

```bash
composer require league/omnipay receiver1/omnipay-pzmpay
```


## Использование

### Инициализация шлюза
```php
// Создаём новый платёжный шлюз
$gateway = Omnipay::create('PZMPay');

// Устанавливаем "секретный код"
$gateway->setSecretCode('secretCode');
```

### Создание платежа
```php
// Создаём новый платёж на сумму 10 руб. 00 коп.
$purchaseResponse = $gateway->purchase([
  'amount' => 10,
  'currency' => 'RUB',
  'description' => 'Пополнение баланса 1337 Cheats',
])->send();

if (!$purchaseResponse->isSuccessful()) {
  throw new Exception($response->getMessage());
}

// Получаем идентификатор платежа в PZMPay
$invoiceId = $purchaseResponse->getTransactionId(); 
// Получаем ссылку на форму оплаты PZMPay
$redirectUrl =$purchaseResponse->getRedirectUrl(); 
```

### Проверка платежа
```php
$notification = $gateway->acceptNotification($data);
if ($notification->getTransactionStatus() == NotificationInterface::STATUS_COMPLETED) {
  /** @var TransactionModel $incomingTransaction */
  $incomingTransaction = $notification->getTransactionReference();

  $transactionResponse = $gateway->fetchTransaction([
    'transactionId' => $incomingTransaction->getId(),
  ])->send();

  /** @var TransactionModel $trustedTransaction */
  $trustedTransaction = $transactionResponse->getTransactionReference();

  print ($trustedTransaction->getAmount());
}
```