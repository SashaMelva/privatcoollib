<?php

namespace PrivatCoolLib;

class ExchangedAmount
{
    public function __construct(
        public string $from,
        public string $to,
        public int    $amount
    )
    {
    }

    public function toDecimal(): float
    {
        $startingUnit = 0;
        $finalUnit = 0;
        $currencies = (new ExchangeRates)->getExchangeRates();

        foreach ($currencies as $currency) {

            if ($currency['rates'][$this->from] > 0) {
                $startingUnit = $currency['rates'][$this->from];
            }

            if ($currency['rates'][$this->to] > 0) {
                $finalUnit = $currency['rates'][$this->to];
            }
        }

        if ($startingUnit > 0 && $finalUnit > 0) {

            return ($finalUnit * $this->amount) / $startingUnit;
        }

        return 0;
    }
}