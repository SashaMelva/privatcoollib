<?php

use GuzzleHttp\Client;
use PrivatCoolLib\ExchangedAmount;
use PrivatCoolLib\RatesFromBank;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$guzzelClient = new Client();
try {
    var_dump(
        (
        new ExchangedAmount(
            100,
            new RatesFromBank ("USD", "UAH", $guzzelClient)
        )
        )->toDecimal()
    );
} catch (InvalidArgumentException $e) {
    echo 'При выполнение привело к Exception:' . $e->getMessage();
}

