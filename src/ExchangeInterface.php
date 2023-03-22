<?php

namespace PrivatCoolLib;

interface ExchangeInterface
{
    public function getRateConvertingCurrencyToRuble(): float;
    public function getRateConvertedToCurrencyToRuble(): float;
}