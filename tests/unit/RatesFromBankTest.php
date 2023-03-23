<?php

namespace tests\unit;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use PrivatCoolLib\RatesFromBank;

class RatesFromBankTest extends TestCase
{
    /**
     * @throws GuzzleException
     * @dataProvider dataProviderGetRateConvertingCurrencyToRuble
     */
    public function testGetRateConvertingCurrencyToRuble(array $catch): void
    {
        $sut = new RatesFromBank (
            $catch[0],
            $catch[1],
            (new FakeGuzzleClient)->getFakeGuzzleClient()
        );
        $this->assertEquals(
            $catch[2],
            $sut->getRateConvertingCurrencyToRuble()
        );
    }

    public function dataProviderGetRateConvertingCurrencyToRuble(): array
    {
        return [
            [["AUD", "UAH", 0.01940914675]],
            [["KZT", "UAH", 6.0080989]],
            [["PLN", "UAH", 0.0564088968]],
        ];
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
     * @dataProvider dataProviderGetInvalidRateConvertingCurrencyToRuble
     */
    public function testGetRateConvertedToCurrencyToRuble(array $catch): void
    {
        $sut = new RatesFromBank ($catch[0], $catch[1], (new FakeGuzzleClient)->getFakeGuzzleClient());
        $this->assertEquals(
            $catch[2],
            $sut->getRateConvertedToCurrencyToRuble()
        );
    }
    public function dataProviderGetInvalidRateConvertingCurrencyToRuble() :array
    {
        return [
            [["USD", "HKD", 0.101798266]],
            [["USD", "SGD", 0.01737094]],
            [["USD", "RSD", 1.41522985]]
        ];
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
