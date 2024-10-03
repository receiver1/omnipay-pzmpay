<?php

namespace Omnipay\PZMPay\Message;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse {
  public function isSuccessful(): bool {
    return !array_key_exists('error', $this->getData());
  }

  public function getCode(): int {
    return $this->getData()['error']['code'];
  }

  public function getMessage(): string {
    return $this->getData()['error']['message'];
  }
}