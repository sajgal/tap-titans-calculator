<?php namespace Titans;

/**
 *
 * Number mechanizm in game:
 *
 * base value: 1 coin
 *
 * 1000 coins = 1K
 * 1000K = 1M
 * 1000M = 1B
 * 1000B = 1T
 * 1000T = 1aa
 * 1000aa = 1bb
 * 1000bb = 1cc
 * 1000cc = 1dd
 * ...
 *
 */


class Number
{
    private $value;
    private $currency;
    private $currencyLadder = ['K', 'M', 'B', 'T'];

    public function __construct($value, $currency = NULL)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function getBase()
    {
        if(strlen($this->currency) < 2) {
            return $this->getBasicConversion();
        } else {
            return $this->getDoubleConversion();
        }
    }

    private function getBasicConversion()
    {
        if(is_null($this->currency)) {
            return $this->value;
        }

        $exp = array_search(strtoupper($this->currency), $this->currencyLadder)+1;

        return $this->value * pow(1000, $exp);
    }

    private function getDoubleConversion()
    {
        $exp = ord($this->currency)-96;
        $valueWithBasicConversion = $this->value * pow(1000, count($this->currencyLadder));

        return $valueWithBasicConversion * pow(1000, $exp);
    }

    public function getCurrencies($count = 8)
    {
        $out = array();

        $out = array_merge($out, $this->currencyLadder);
        $countForDoubleCurrencies = $count - count($this->currencyLadder);

        for ($i = 1; $i <= $countForDoubleCurrencies; $i++) {
            $out[] = str_repeat(chr($i+96), 2);
        }

        return $out;

    }
}