<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use PrivatCoolLib\ExchangedAmount;
use PrivatCoolLib\RatesFromBank;

class ExchangedAmountTest extends TestCase
{
    /**
    * @dataProvider dataProviderToDecimal
     */
    public function testToDecimal(array $catch): void
    {
        $this->assertEquals(
            $catch[0],
            (
                new ExchangedAmount(
                    $catch[1],
                    new RatesFromBank(
                        $catch[2],
                        $catch[3],
                        (new FakeGuzzleClient)->getFakeGuzzleClient()
                    )
                )
            )->toDecimal()
        );
    }

    public function dataProviderToDecimal(): array
    {
        return [
            [[3692.68, 100, "USD", "UAH"]],
            [[139.92, 1000, "JPY", "ZAR"]],
            [[539.05, 500, "EUR", "USD"]]
        ];
    }


    /**
    * @dataProvider dataProviderForExceptionsToDecimal
     */
    public function testForExceptionsToDecimal(array $case): void
    {
        $this->expectException($case[1]);

        (new ExchangedAmount(
            $case[0],
            new RatesFromBank(
                "USD",
                "UAH",
                (new FakeGuzzleClient)->getFakeGuzzleClient()
            )
        ))->toDecimal();
    }

    public function dataProviderForExceptionsToDecimal(): array
    {
        return [
            [["", \TypeError::class]],
            [["sdfse", \TypeError::class]],
            [[null, \InvalidArgumentException::class]],
        ];
    }
}