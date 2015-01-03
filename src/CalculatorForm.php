<?php namespace Titans;

use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Forms\Controls\RadioList;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\TextBase;
use Nette\Forms\Form;

class CalculatorForm
{
    public function getForm()
    {
        $form = new Form;

        $form->setMethod('GET');

        $form->addText('heroDps', 'Hero DPS:')
            ->addRule(Form::FLOAT, 'Hero DPS must be a float number')
            ->setRequired('Hero DPS is required.');

        $currencies = $this->getCurrencies();
        $prompt = '-';

        $form->addSelect('heroDpsCurrency', NULL)
            ->setItems($currencies, FALSE)
            ->setPrompt($prompt);

        $form->addText('coinsNumber', '# of Coins')
            ->addRule(Form::INTEGER, 'Number of Coins must be a number')
            ->setRequired('Number of Coins is required.');
        $form->addText('coinValue', '1 Coin value')
            ->addRule(Form::FLOAT, 'Value of one Coin must be a float number')
            ->setRequired('Value of one Coin is required.');
        $form->addSelect('coinValueCurrency', NULL)
            ->setItems($currencies, FALSE)
            ->setPrompt($prompt);


        $form->addText('monsterHealth', 'Monster HP:')
            ->addRule(Form::FLOAT, 'Monster Health must be a float number')
            ->setRequired('Monster Health is required.');
        $form->addSelect('monsterHealthCurrency', NULL)
            ->setItems($currencies, FALSE)
            ->setPrompt($prompt);

        $form->addText('moneyNeeded', '$$ needed:')
            ->addRule(Form::FLOAT, 'Money Needed must be a float number')
            ->setRequired('Money Needed is required.');

        $form->addSelect('moneyNeededCurrency', NULL)
            ->setItems($currencies, FALSE)
            ->setPrompt($prompt);

        $form->addSubmit('submit', 'Calculate');

        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = NULL;
        $renderer->wrappers['pair']['container'] = 'div class=form-group';
        $renderer->wrappers['pair']['.error'] = 'has-error';
        $renderer->wrappers['control']['container'] = 'div class=col-sm-8';
        $renderer->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
        $renderer->wrappers['control']['description'] = 'span class=help-block';
        $renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';

        // make form and controls compatible with Twitter Bootstrap
        $form->getElementPrototype()->class('form-horizontal');
        foreach ($form->getControls() as $control) {
            if ($control instanceof Button) {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary btn-block' : 'btn btn-default btn-block');
                $usedPrimary = TRUE;
            } elseif ($control instanceof TextBase || $control instanceof SelectBox || $control instanceof MultiSelectBox) {
                $control->getControlPrototype()->addClass('form-control');
            } elseif ($control instanceof Checkbox || $control instanceof CheckboxList || $control instanceof RadioList) {
                $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
            }
        }

        return $form;
    }

    private function getCurrencies()
    {
        $number = new Number(1);
        return $number->getCurrencies();
    }

}