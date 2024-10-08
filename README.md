# Omnipay: PZMPay
PZMPay online acquiring support for Omnipay

[![Total Downloads](https://img.shields.io/packagist/dt/receiver1/omnipay-pzmpay.svg?style=flat-square)](https://packagist.org/packages/receiver1/omnipay-pzmpay)
[![Latest Version](https://img.shields.io/packagist/v/receiver1/omnipay-pzmpay.svg?style=flat-square)](https://github.com/receiver1/omnipay-pzmpay/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## Already Implemented
* Payment creation
* Payment information
* Incoming notifications

## To Be Implemented
* Payment cancellation
* Project balance
* Fiscalization under Federal Law 54
* Testing mode
* Error codes

## Installation
```bash
composer require league/omnipay receiver1/omnipay-pzmpay
```

## Usage
### Gateway Initialization
```php
// Create a new payment gateway
$gateway = Omnipay::create('PZMPay');

// Set the secret code
$gateway->setSecretCode('secretCode');
```

### Payment Creation
```php
// Create a new payment for 10 rubles 00 kopecks
$purchaseResponse = $gateway->purchase([
  'amount' => 10,
  'currency' => 'RUB',
  'description' => 'Balance top-up 1337 Cheats',
])->send();

if (!$purchaseResponse->isSuccessful()) {
  throw new Exception($response->getMessage());
}

// Get the payment identifier in PZMPay
$invoiceId = $purchaseResponse->getTransactionId();
// Get the link to the PZMPay payment form
$redirectUrl = $purchaseResponse->getRedirectUrl();
```

### Payment Verification
```php
$notification = $gateway->acceptNotification($data);
if ($notification->getTransactionStatus() === NotificationInterface::STATUS_COMPLETED) {
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