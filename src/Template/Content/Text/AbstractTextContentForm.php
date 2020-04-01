<?php


namespace Nemundo\Process\Template\Content\Text;


use Nemundo\Core\Random\RandomText;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Form\AbstractContentForm;

abstract class AbstractTextContentForm extends AbstractContentForm
{

    /**
     * @var AbstractTextContentType
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    protected $text;

    protected function loadContainer()
    {
        parent::loadContainer();

        $this->text = new BootstrapTextBox($this);
        $this->text->label = 'Text';
        //$this->text->maxLength = 255;

        if (ProcessConfig::$debugMode) {
            $this->text->value = (new RandomText())->getText();
        }

    }


    protected function loadUpdateForm()
    {

        $textRow = $this->contentType->getDataRow();
        $this->text->value = $textRow->text;

    }


    protected function onSubmit()
    {

        $this->contentType->text = $this->text->getValue();
        $this->contentType->saveType();

    }

}