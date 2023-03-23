<?php

namespace PrivatCoolLib;
class ExchangedAmount
{
    public function __construct(
        private float             $amount,
        private ExchangeInterface $exchange
    )
    {
    }

    public function toDecimal(): float
    {
        if (is_null($this->amount)) {
            throw new \InvalidArgumentException("Wrong currency name provided: '$this->amount'");
        }

        $result = ($this->exchange->getRateConvertedToCurrencyToRuble() * $this->amount) / $this->exchange->getRateConvertingCurrencyToRuble();

        return round($result, 2);
    }
}