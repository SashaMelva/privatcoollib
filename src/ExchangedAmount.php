<?php
namespace PrivatCoolLib;
class ExchangedAmount
{
    public function __construct(
        private mixed $amount,
        private ExchangeInterface $exchange
    )
    {
    }

    public function toDecimal(): float
    {
        if (is_null($this->amount) || gettype($this->amount) != "double") {
            throw new \InvalidArgumentException("Wrong currency name provided: '$this->amount'");
        }

        $result = ($this->exchange->getRateConvertedToCurrencyToRuble() * $this->amount) / $this->exchange->getRateConvertingCurrencyToRuble();

        return round($result, 2);
    }
}