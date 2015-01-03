<?php

use Titans\Calculator;
use Titans\CalculatorForm;
use Titans\Loot;
use Titans\Monster;
use Titans\Number;

require_once('vendor/autoload.php');


$heroDps = new Number(539.37, 'bb');
$loot = new Loot(4, new Number(55.46, 'bb'));
$monster = new Monster(new Number(1.12, 'cc'));

$moneyNeeded = new Number(48.7, 'dd');

$calculator = new Calculator($heroDps, $loot, $monster, $moneyNeeded);
$time = $calculator->calculateWaiting();

//echo $time;

$form = new CalculatorForm();

$params = array();
$params['form'] = $form->getForm();

$latte = new Latte\Engine;
$latte->render(__DIR__ . '/templates/@layout.latte', $params);