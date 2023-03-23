<?php

use GuzzleHttp\Client;
use PrivatCoolLib\ExchangedAmount;
use PrivatCoolLib\RatesFromBank;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

try {
    var_dump(
        (
        new ExchangedAmount(
            100,
            new RatesFromBank ("USD", "UAH", new Client())
        )
        )->toDecimal()
    );
} catch (InvalidArgumentException $e) {
    echo 'При выполнение привело к Exception:' . $e->getMessage();
}

