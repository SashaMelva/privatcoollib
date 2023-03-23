<?php
namespace PrivatCoolLib;
class ExchangedAmount
{
    public function __construct(
        private float  $amount,
        private ExchangeInterface $exchange
    )
    {
    }

    public function toDecimal(): float
    {
        $result = ($this->exchange->getRateConvertedToCurrencyToRuble() * $this->amount) / $this->exchange->getRateConvertingCurrencyToRuble();

        return round($result, 1);
    }
}