<?php

namespace Omnipay\PZMPay\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest {
  public function getSecretCode(): string {
    return $this->getParameter('secretCode');
  }

  public function setSecretCode(string $secretCode): void {
    $this->setParameter('secretCode', $secretCode);
  }

  protected function getHeaders(): array {
    return [
      'User-Agent' => 'Omnipay',
      'Authorization' => 'Bearer ' . $this->getSecretCode(),
      'Accept' => 'application/json',
      'Content-Type' => 'application/json',
    ];
  }

  public function getUrl(): string {
    return 'https://pzmpay.com/api';
  }
}