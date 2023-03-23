<?php

namespace tests\unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class FakeGuzzleClient
{
    public function getFakeGuzzleClient(): Client
    {
        $mock = new MockHandler(
            [
                new Response(
                    200,
                    ['Content-Type' => 'application/json'],
                    $this->getTestData()
                )
            ]
        );

        return new Client(['handler' => HandlerStack::create($mock)]);
    }

    public function getTestData(): string
    {
        return '{
            "disclaimer": "https://www.cbr-xml-daily.ru/#terms",
            "date": "2023-03-23",
            "timestamp": 1679518800,
            "base": "RUB",
            "rates": {
                    "AUD": 0.01940914675,
                "AZN": 0.0220905,
                "GBP": 0.01065465,
                "AMD": 5.044034,
                "BYN": 0.037164,
                "BGN": 0.02358485,
                "BRL": 0.068144,
                "HUF": 4.70254078,
                "VND": 306.889673,
                "HKD": 0.101798266,
                "GEL": 0.033476277,
                "DKK": 0.0897956,
                "AED": 0.047723357,
                "USD": 0.01299442,
                "EUR": 0.01205298,
                "EGP": 0.401358,
                "INR": 1.071981,
                "IDR": 199.750312,
                "KZT": 6.0080989,
                "CAD": 0.0178101685,
                "QAR": 0.04729966,
                "KGS": 1.1359725,
                "CNY": 0.089648,
                "MDL": 0.2421448,
                "NZD": 0.021006,
                "NOK": 0.1368208,
                "PLN": 0.0564088968,
                "RON": 0.0593116,
                "XDR": 0.0096845359,
                "SGD": 0.01737094,
                "TJS": 0.14181078,
                "THB": 0.447511,
                "TRY": 0.247135697,
                "TMT": 0.04548038658,
                "UZS": 148.37015385985,
                "UAH": 0.4798418,
                "CZK": 0.2875017,
                "SEK": 0.134491,
                "CHF": 0.011978257,
                "RSD": 1.41522985,
                "ZAR": 0.240807,
                "KRW": 16.992815,
                "JPY": 1.7209808
            }
        }';
    }
}