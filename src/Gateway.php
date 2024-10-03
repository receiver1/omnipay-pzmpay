<?php

namespace Omnipay\PZMPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\PZMPay\Message\FetchTransactionRequest;
use Omnipay\PZMPay\Message\NotificationRequest;
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

  public function fetchTransaction(array $options = []) {
    return $this->createRequest(FetchTransactionRequest::class, $options);
  }

  public function acceptNotification(array $options = []): NotificationInterface {
    /** @var NotificationInterface $notification */
    $notification = $this->createRequest(NotificationRequest::class, $options);
    return $notification;
  }
}