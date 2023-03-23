<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use PrivatCoolLib\ExchangedAmount;
use PrivatCoolLib\RatesFromBank;

class ExchangedAmountTest extends TestCase
{
    public function testToDecimal()
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
}