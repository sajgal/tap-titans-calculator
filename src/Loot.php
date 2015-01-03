<?php namespace Titans;


class Loot
{
    private $numberOfCoins;
    /**
     * @var Number
     */
    private $oneCoinValue;

    public function __construct($numberOfCoins, Number $oneCoinValue)
    {
        $this->numberOfCoins = $numberOfCoins;
        $this->oneCoinValue = $oneCoinValue;
    }

    public function getBaseNumber()
    {
        return $this->oneCoinValue->getBase() * $this->numberOfCoins;
    }
}