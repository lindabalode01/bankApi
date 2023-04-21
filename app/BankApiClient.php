<?php

namespace App;

use GuzzleHttp\Client;
class BankApiClient
{
    public Client $client;
    public array $currencies;
public function __construct()
{
    $this->client = new Client();
}
public function bankInfo(): array
{
    $url = 'https://www.latvijasbanka.lv/vk/ecb.xml';
    $response = $this->client->request('GET', $url);
    $bankCurrencyInfo = simplexml_load_string($response->getBody()->getContents());
    foreach ($bankCurrencyInfo->Currencies->Currency as $currency)
    {
        $this->currencies[] = new CurrencyInfo(
            (string)$currency->ID,
            (float)$currency->Rate
        );
    }
    return $this->currencies;
}
public function convert( string $currency, float $amount)
{
    $currencyCode = strtoupper($currency);
    $currencyRate = 0.0;
    foreach ($this->bankInfo() as $currency) {
        /** @var CurrencyInfo $currency */
        if ($currencyCode === $currency->getCurrencyName()) {
            $currencyRate = $currency->getCurrencyRate();
            break;
        }
    }
    return $amount * $currencyRate;
}
}