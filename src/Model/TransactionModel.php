<?php

namespace Omnipay\PZMPay\Model;

class TransactionModel {
  private string $id;
  private float $amount;
  private string $currency;
  private string $status;
  private int $createdAt;
  private int $updatedAt;
  private string $description;

  public function __construct(string $id, float $amount, string $currency, string $status, int $createdAt, int $updatedAt, string $description) {
    $this->id = $id;
    $this->amount = $amount;
    $this->currency = $currency;
    $this->status = $status;
    $this->createdAt = $createdAt;
    $this->updatedAt = $updatedAt;
    $this->description = $description;
  }

  public function getId(): string {
    return $this->id;
  }

  public function getAmount(): float {
    return $this->amount;
  }

  public function getCurrency(): string {
    return $this->currency;
  }

  public function getStatus(): string {
    return $this->status;
  }

  public function getCreatedAt(): int {
    return $this->createdAt;
  }

  public function getUpdatedAt(): int {
    return $this->updatedAt;
  }

  public function getDescription(): string {
    return $this->description;
  }
}