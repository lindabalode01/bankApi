<?php
namespace App;
class CurrencyInfo
{
    private string $currencyName;
    private float $currencyRate;
public function __construct
(
    string $name,
    float $rate
)
{
    $this->currencyName = $name;
    $this->currencyRate = $rate;
}
public function getCurrencyName(): string
{
    return $this->currencyName;
}
public function getCurrencyRate(): float
{
    return $this->currencyRate;
}
}