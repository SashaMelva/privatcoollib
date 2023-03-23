<?php

namespace PrivatCoolLib;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RatesFromBank implements ExchangeInterface
{
    private array $exchangeRates;

    public function __construct(
        private string $convertingCurrency,
        private string $convertedToCurrency,
        private Client $guzzleClient,
    )
    {
    }

    /**
     * @throws GuzzleException
     */
    public function getRateConvertingCurrencyToRuble(): float
    {
        $rateConvertingCurrencyToRuble = $this->getExchangeRates()[$this->convertingCurrency] ?? null;

        if (is_null($rateConvertingCurrencyToRuble)) {
            throw new \InvalidArgumentException("Wrong currency name provided: '$rateConvertingCurrencyToRuble'");
        }

        return $rateConvertingCurrencyToRuble;
    }

    /**
     * @throws GuzzleException
     */
    public function getRateConvertedToCurrencyToRuble(): float
    {
        $rateConvertedToCurrencyToRuble = $this->getExchangeRates()[$this->convertedToCurrency] ?? null;

        if (is_null($rateConvertedToCurrencyToRuble)) {
            throw new \InvalidArgumentException("Wrong currency name provided: '$rateConvertedToCurrencyToRuble'");
        }

        return $rateConvertedToCurrencyToRuble;
    }


    /**
     * @throws GuzzleException
     */
    public function getExchangeRates()
    {
        if (isset($this->exchangeRates)) {
            return $this->exchangeRates;
        }

        $response = $this->guzzleClient->get("https://www.cbr-xml-daily.ru/latest.js");

        $results = json_decode($response->getBody(), true);
        return $this->exchangeRates = $results['rates'];
    }
}