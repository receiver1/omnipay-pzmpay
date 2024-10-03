<?php

namespace Omnipay\PZMPay\Message;

use Omnipay\PZMPay\Message\AbstractRequest;

class FetchTransactionRequest extends AbstractRequest {
  public function getMethod(): string {
    return 'payment/info';
  }

  public function getData(): array {
    $this->validate('transactionId');

    return [
      'id' => $this->getTransactionId(),
    ];
  }

  public function sendData($requestData): FetchTransactionResponse {
    $uri = "{$this->getUrl()}/{$this->getMethod()}";

    $response = $this->httpClient->request('POST', $uri,
      $this->getHeaders(), json_encode($requestData));

    $responseData = json_decode($response->getBody(), true);
    $this->response = new FetchTransactionResponse($this, $responseData);
    return $this->response;
  }
}