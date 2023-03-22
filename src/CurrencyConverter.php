<?php
declare(strict_types=1);

namespace PrivatCoolLib;
class CurrencyConverter
{
    public function __construct(
        private float  $amount,
        private ExchangeInterface $exchange
    )
    {
    }


    public function convert(): float
    {
        $result = ($this->exchange->getRateConvertedToCurrencyToRuble() * $this->amount) / $this->exchange->getRateConvertingCurrencyToRuble();

        return round($result, 2);
    }

    public function __toString(): string
    {
        return (string)$this->convert();
    }
}