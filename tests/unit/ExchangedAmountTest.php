<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use PrivatCoolLib\ExchangedAmount;
use PrivatCoolLib\RatesFromBank;

class ExchangedAmountTest extends TestCase
{
    public function testToDecimal(): void
    {
        $this->assertEquals(
            3692.7,
            (
            new ExchangedAmount(
                100,
                new RatesFromBank(
                    "USD",
                    "UAH",
                    (new FakeGuzzleClient)->getFakeGuzzleClient()
                )
            )
            )->toDecimal()
        );
    }

    /**
    * @dataProvider dataProviderForExceptionsToDecimal
     */
    public function testForExceptionsToDecimal(array $case): void
    {
        $this->expectException(\InvalidArgumentException::class);

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
            [[""]],
            [["sdfse"]],
            [[null]],
        ];
    }
}