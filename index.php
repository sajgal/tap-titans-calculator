<?php

use Titans\Calculator;
use Titans\CalculatorForm;
use Titans\Loot;
use Titans\Monster;
use Titans\Number;

require_once('vendor/autoload.php');

$form = (new CalculatorForm)->getForm();
$templateParameters = array();

if($form->isSuccess()) {
    $formValues = $form->getValues();

    $heroDps = new Number($formValues->heroDps, $formValues->heroDpsCurrency);
    $loot = new Loot($formValues->coinsNumber, new Number($formValues->coinValue, $formValues->coinValueCurrency));
    $monster = new Monster(new Number($formValues->monsterHealth, $formValues->monsterHealthCurrency));

    $moneyNeeded = new Number($formValues->moneyNeeded, $formValues->moneyNeededCurrency);

    $calculator = new Calculator($heroDps, $loot, $monster, $moneyNeeded);
    $calculations = $calculator->calculateWaiting();

    $templateParameters['calculations'] = $calculations;
}


$templateParameters['form'] = $form->getForm();

$latte = new Latte\Engine;
$latte->render(__DIR__ . '/templates/@layout.latte', $templateParameters);