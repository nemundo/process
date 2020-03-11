<?php


namespace Nemundo\Process\Template\Content\Number;


use Nemundo\Core\Random\RandomNumber;
use Nemundo\Core\Random\RandomText;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\Number\AbstractNumberContentType;

abstract class AbstractNumberContentForm extends AbstractContentForm
{

    /**
     * @var AbstractNumberContentType
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

        $textRow = $this->contentType->getDataRow();
        $this->number->value = (int)$textRow->text;

    }


    protected function onSubmit()
    {

        //$this->contentType->fromDataId($this->dataId);
        //$this->contentType->parentId = $this->parentId;
        $this->contentType->number = (int)$this->number->getValue();
        $this->contentType->saveType();

    }

}