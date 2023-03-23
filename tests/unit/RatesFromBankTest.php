<?php

namespace tests\unit;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use PrivatCoolLib\RatesFromBank;

class RatesFromBankTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testGetRateConvertingCurrencyToRuble()
    {
        $sut = new RatesFromBank (
            "AUD",
            "UAH",
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        );
        $this->assertEquals(
            0.01940914675,
            $sut->getRateConvertingCurrencyToRuble()
        );
    }

    /**
     * @throws GuzzleException
     */
    public function testGetInvalidRateConvertingCurrencyToRuble()
    {
        $sut = new RatesFromBank (
            "efsd",
            "UAH",
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        );
        $this->assertEquals(
            0,
            $sut->getRateConvertingCurrencyToRuble()
        );
    }

    /**
     * @throws GuzzleException
     */
    public function testGetRateConvertedToCurrencyToRuble(): void
    {
        $sut = new RatesFromBank (
            "USD",
            "HKD",
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        );
        $this->assertEquals(
            0.101798266,
            $sut->getRateConvertedToCurrencyToRuble()
        );
    }

    /**
     * @throws GuzzleException
     */
    public function testGetNullRateConvertedToCurrencyToRuble(): void
    {
        $sut = new RatesFromBank (
            "USD",
            null,
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        );
        $this->assertEquals(
            0,
            $sut->getRateConvertedToCurrencyToRuble()
        );
    }
}
