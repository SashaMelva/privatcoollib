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
     * @dataProvider dataProviderForExceptionsRateConvertingCurrencyToRuble
     * @throws GuzzleException
     */
    public function testForExceptionsRateConvertingCurrencyToRuble(array $case): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (new RatesFromBank (
            $case[0],
            $case[1],
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        ))->getRateConvertingCurrencyToRuble();
    }

    public function dataProviderForExceptionsRateConvertingCurrencyToRuble(): array
    {
        return [
            [["", "UAH"]],
            [["000", "UAH"]],
            [["QWQW", "UAH"]],
            [[null, "UAH"]],
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function testGetInvalidRateConvertingCurrencyToRuble()
    {
        $this->expectException(\InvalidArgumentException::class);
        (new RatesFromBank (
            null,
            "UAH",
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        ))->getRateConvertingCurrencyToRuble();
    }

    /**
     * @throws GuzzleException
     */
    public function testGetRateConvertedToCurrencyToRuble(): void
    {
        $sut = new RatesFromBank ("USD", "HKD", (new FakeGuzzleClient)->getFakeGuzzleClient());
        $this->assertEquals(
            0.101798266,
            $sut->getRateConvertedToCurrencyToRuble()
        );
    }

    /**
     * @throws GuzzleException
     * @dataProvider dataProviderForExceptionsRateConvertedToCurrencyToRuble
     */
    public function testForExceptionsRateConvertedToCurrencyToRuble(array $case): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (new RatesFromBank (
            $case[0],
            $case[1],
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        ))->getRateConvertedToCurrencyToRuble();
    }

    public function dataProviderForExceptionsRateConvertedToCurrencyToRuble(): array
    {
        return [
            [["UAH", ""]],
            [["UAH", "222"]],
            [["UAH", "QWWQW"]],
            [["UAH", null]],
        ];
    }
}
