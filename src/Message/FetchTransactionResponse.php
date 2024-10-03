<?php

namespace Omnipay\PZMPay\Message;

use Omnipay\PZMPay\Message\AbstractResponse;
use Omnipay\PZMPay\Model\TransactionModel;

class FetchTransactionResponse extends AbstractResponse {
  public function getTransactionReference(): TransactionModel {
    return new TransactionModel(
      intval($this->getData()['id']),
      doubleval($this->getData()['amount']),
      $this->getData()['currency'],
      $this->getData()['status'],
      intval($this->getData()['created']),
      intval($this->getData()['updated']),
      $this->getData()['description']);
  }
}