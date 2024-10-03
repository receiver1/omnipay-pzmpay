<?php

namespace Omnipay\PZMPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\PZMPay\Message\PurchaseRequest;

class Gateway extends AbstractGateway {
  public function getName() {
    return 'PZMPay';
  }

  public function getSecretCode(): string {
    return $this->getParameter('sercetCode');
  }

  public function setSecretCode(string $secretCode): void {
    $this->setParameter('secretCode', $secretCode);
  }

  public function purchase(array $options = []) {
    return $this->createRequest(PurchaseRequest::class, $options);
  }
}