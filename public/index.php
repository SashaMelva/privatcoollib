<?php

require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
use PrivatCoolLib\ExchangedAmount;

$amount = new ExchangedAmount("USD", "UAH", 100);
var_dump($amount->toDecimal());