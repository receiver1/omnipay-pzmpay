<?php

namespace Omnipay\PZMPay\Message;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface {
  public function isSuccessful(): bool {
    return !in_array('error', $this->getData());
  }

  public function isRedirect(): bool {
    return true;
  }

  public function getCode(): int {
    return $this->getData()['error']['code'];
  }

  public function getMessage(): string {
    return $this->getData()['error']['message'];
  }

  public function getTransactionId(): string {
    return $this->getData()['invoiceId'];
  }

  public function getRedirectUrl(): string {
    return $this->getData()['redirectUrl'];
  }

  public function getRedirectMethod() {
    return 'GET';
  }
}