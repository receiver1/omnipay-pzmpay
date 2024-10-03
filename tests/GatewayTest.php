<?php

namespace Omnipay\PZMPay;

use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase {
  protected $gateway;

  protected function setUp(): void {
    parent::setUp();

    $this->gateway = Omnipay::create('PZMPay');
    $this->gateway->initialize([]);
  }
}