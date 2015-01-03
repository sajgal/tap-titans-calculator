<?php namespace Titans;


use DateTime;

class Calculator
{
    /**
     * @var Number
     */
    private $heroDps;
    /**
     * @var Loot
     */
    private $loot;
    /**
     * @var Monster
     */
    private $monster;
    /**
     * @var Number
     */
    private $moneyNeeded;

    public function __construct(Number $heroDps, Loot $loot, Monster $monster, Number $moneyNeeded)
    {
        $this->heroDps = $heroDps;
        $this->loot = $loot;
        $this->monster = $monster;
        $this->moneyNeeded = $moneyNeeded;
    }

    public function calculateWaiting()
    {
        $monsterKillTimeInSeconds = $this->monster->getHealth() / $this->heroDps->getBase();
        $oneSecondLoot = $this->loot->getBaseNumber() / $monsterKillTimeInSeconds;
        $secondsNeeded = $this->moneyNeeded->getBase() / $oneSecondLoot;

        return 'Monster killed in ' . round($monsterKillTimeInSeconds, 2) . ' s <br />' .
//               'One second Loot = ' . $oneSecondLoot . '<br />' .
               'Time Needed: ' . $this->secondsToTime($secondsNeeded);

    }

    function secondsToTime($inputSeconds) {

        $secondsInAMinute = 60;
        $secondsInAnHour  = 60 * $secondsInAMinute;
        $secondsInADay    = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'd' => (int) $days,
            'h' => (int) $hours,
            'm' => (int) $minutes,
            's' => (int) $seconds,
        );

        return sprintf('%02d days, %02d hours, %02d minutes, %02d seconds', $obj['d'] , $obj['h'], $obj['m'], $obj['s']);
    }
}