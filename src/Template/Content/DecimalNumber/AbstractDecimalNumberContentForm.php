<?php


namespace Nemundo\Process\Template\Content\DecimalNumber;


use Nemundo\Core\Random\RandomNumber;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Form\AbstractContentForm;

abstract class AbstractDecimalNumberContentForm extends AbstractContentForm
{

    /**
     * @var AbstractDecimalNumberContentType
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    protected $number;

    protected function loadContainer()
    {
        parent::loadContainer();

        $this->number = new BootstrapTextBox($this);
        $this->number->label = 'Text';

        if (ProcessConfig::$debugMode) {
            $this->number->value = (new RandomNumber())->getNumber();
        }

    }


    protected function loadUpdateForm()
    {

        $dataRow = $this->contentType->getDataRow();
        $this->number->value = $dataRow->decimalNumber;

    }


    protected function onSubmit()
    {

        $this->contentType->decimalNumber = (float)$this->number->getValue();
        $this->contentType->saveType();

    }

}