<?php

use PrivatCoolLib\CurrencyConverter;
use PrivatCoolLib\RatesFromCbr;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";


var_dump(
    (new CurrencyConverter(
        100,
        new RatesFromCbr ("USD", "UAH")
    ))->convert()
);