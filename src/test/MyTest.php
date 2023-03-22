<?php declare(strict_types=1);

namespace PrivatCoolLib\test;

use PrivatCoolLib\CurrencyConverter;
use PrivatCoolLib\ExchangeRates;

use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    public function testToDecimal()
    {
        $mockDataFetcher = $this->getMockBuilder(ExchangeRates::class)
            ->setMethods(['getExchangeRates'])
            ->getMock();
        $mockDataFetcher->expects($this->once())
            ->method('getExchangeRates')
            ->with('UAH', 'USD')
            ->willReturn($this->testData());
        $exchange = new CurrencyConverter('AUD', 'USD', 100, $this->testData());
        $this->assertEquals(66.909887118216, $exchange->round());
    }

    public function testData(): array
    {
        return ['data' =>
            [
                "disclaimer" => "https://www.cbr-xml-daily.ru/#terms",
                "date" => "2023-03-22",
                "timestamp" => 1679432400,
                "base" => "RUB",
                "rates" => [
                    "AUD" => 0.01945078756,
                    "AZN" => 0.02212467698,
                    "GBP" => 0.010619758,
                    "AMD" => 5.0541808,
                    "BYN" => 0.0372253698,
                    "BGN" => 0.0237515,
                    "BRL" => 0.068279,
                    "HUF" => 4.743923,
                    "VND" => 307.364137,
                    "HKD" => 0.1019296,
                    "GEL" => 0.03352925595,
                    "DKK" => 0.09041,
                    "AED" => 0.0477984,
                    "USD" => 0.0130145,
                    "EUR" => 0.012114927,
                    "EGP" => 0.4019777,
                    "INR" => 1.0718998,
                    "IDR" => 200.0592175,
                    "KZT" => 6.01739,
                    "CAD" => 0.01779603,
                    "QAR" => 0.0473729,
                    "KGS" => 1.1377289,
                    "CNY" => 0.089564,
                    "MDL" => 0.2427308,
                    "NZD" => 0.0208565797,
                    "NOK" => 0.13690228,
                    "PLN" => 0.056704,
                    "RON" => 0.0595479,
                    "XDR" => 0.009713915,
                    "SGD" => 0.0174238,
                    "TJS" => 0.1420299,
                    "THB" => 0.444227,
                    "TRY" => 0.247393,
                    "TMT" => 0.0455508,
                    "UZS" => 148.59945,
                    "UAH" => 0.480649,
                    "CZK" => 0.29126496,
                    "SEK" => 0.1347015,
                    "CHF" => 0.0120605,
                    "RSD" => 1.4249297,
                    "ZAR" => 0.241324,
                    "KRW" => 17.06464257,
                    "JPY" => 1.7257238
                ],
            ]
        ];
    }
}