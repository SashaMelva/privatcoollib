<?php

namespace PrivatCoolLib;

class ExchangeRates
{
    public function getExchangeRates(): array
    {
        $url = 'https://www.cbr-xml-daily.ru/latest.js';
        $response = file_get_contents($url);
        return ['data' => json_decode($response, true)];
    }
}