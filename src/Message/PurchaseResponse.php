<?php

namespace Omnipay\PZMPay\Message;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface {
  public function isRedirect(): bool {
    return true;
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