<?php namespace Titans;


class Monster
{
    /**
     * @var Number
     */
    private $health;

    public function __construct(Number $health)
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health->getBase();
    }
}