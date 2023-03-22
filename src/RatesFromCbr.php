<?php

namespace PrivatCoolLib;

class RatesFromCbr implements ExchangeInterface
{
    private array $exchangeRates;

    public function __construct(
        private string $convertingCurrency,
        private string $convertedToCurrency,
    )
    {
    }

    public function getRateConvertingCurrencyToRuble(): float
    {
        $rateConvertingCurrencyToRuble = $this->getExchangeRates()['rates'][$this->convertingCurrency] ?? null;

        if (is_null($rateConvertingCurrencyToRuble)) {
            throw new \InvalidArgumentException("Wrong currency name provided: '$rateConvertingCurrencyToRuble'");
        }

        return $rateConvertingCurrencyToRuble;
    }

    public function getRateConvertedToCurrencyToRuble(): float
    {
        $rateConvertedToCurrencyToRuble = $this->getExchangeRates()['rates'][$this->convertedToCurrency] ?? null;

        if (is_null($rateConvertedToCurrencyToRuble)) {
            throw new \InvalidArgumentException("Wrong currency name provided: '$rateConvertedToCurrencyToRuble'");
        }

        return $rateConvertedToCurrencyToRuble;
    }


    private function getExchangeRates(): array
    {
        if (!property_exists($this, 'exchangeRates')) {
            return $this->exchangeRates;
        }

        $url = 'https://www.cbr-xml-daily.ru/latest.js';
        $response = file_get_contents($url);

        return $this->exchangeRates = json_decode($response, true);
    }
}