<?php

namespace Omnipay\PZMPay\Message;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\PZMPay\Message\AbstractRequest;
use Omnipay\PZMPay\Model\TransactionModel;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class NotificationRequest extends AbstractRequest implements NotificationInterface {
  private $data;

  public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest) {
    parent::__construct($httpClient, $httpRequest);

    $this->data = json_decode($httpRequest->getContent(), true);
  }

  public function getData(): array {
    return $this->data;
  }

  public function sendData($data) {
    return $this;
  }

  public function isValid(): bool {
    $headers = $this->httpRequest->headers;
    return $headers->has('Authorization') &&
      $headers->get('Authorization') === $this->getSecretCode();
  }

  public function getTransactionReference(): TransactionModel {
    $transaction = $this->data['object'];
    return new TransactionModel(
      intval($transaction['id']),
      doubleval($transaction['amount']['value']),
      $transaction['amount']['currency'],
      $transaction['status'],
      intval($transaction['created']),
      intval($transaction['updated']),
      $transaction['description']);
  }

  public function getTransactionStatus(): string {
    [$type, $state] = explode('.', $this->data['event']);
    switch ($state) {
      case 'succeeded':
        return NotificationInterface::STATUS_COMPLETED;
      case 'pending':
        return NotificationInterface::STATUS_PENDING;
      case 'canceled':
        return NotificationInterface::STATUS_FAILED;
    }
    return NotificationInterface::STATUS_FAILED;
  }

  public function getMessage() {
    return null;
  }
}