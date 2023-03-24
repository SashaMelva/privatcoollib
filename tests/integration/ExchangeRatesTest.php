<?php

namespace tests\integration;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use PrivatCoolLib\RatesFromBank;

class ExchangeRatesTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testRequestOnNull() {
        $response = (new RatesFromBank(null, null, new Client()))->getExchangeRates();
        $this->assertNotNull($response);
    }

    /**
     * @dataProvider dataProviderForResponseData
     * @throws GuzzleException
     */
    public function testRequestOnCheckNumber(array $catch)
    {
        $response = (new RatesFromBank(null, null, new Client()))->getExchangeRates();
        $this->assertTrue($response[$catch[0]] > 0);
    }

    public function dataProviderForResponseData(): array
    {
        return [
            [["AUD", 0.0194406]],
            [["AZN", 0.02227836]],
            [["GBP", 0.0107136]],
            [["AMD", 5.0890326]]
        ];
    }
}