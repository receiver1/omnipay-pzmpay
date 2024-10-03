<?php

namespace Omnipay\PZMPay\Message;

class PurchaseRequest extends AbstractRequest {
  public function getMethod(): string {
    return 'payment/create';
  }

  public function getData() {
    $this->validate('amount', 'currency', 'description');

    return [
      'amount' => $this->getAmount(),
      'currency' => $this->getCurrency(),
      'description' => $this->getDescription(),
    ];
  }

  // protected function getCurrencies(): array {
  //   return ['USD', 'RUB', 'THB', 'KZT', 'HKD', 'EUR'];
  // }

  public function sendData($requestData): PurchaseResponse {
    $uri = "{$this->getUrl()}/{$this->getMethod()}";

    $response = $this->httpClient->request('POST', $uri,
      $this->getHeaders(), json_encode($requestData));

    $responseData = json_decode($response->getBody(), true);
    $this->response = new PurchaseResponse($this, $responseData);
    return $this->response;
  }
}