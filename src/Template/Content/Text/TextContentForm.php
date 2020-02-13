<?php


namespace Nemundo\Process\Template\Content\Text;


use Nemundo\Core\Random\RandomText;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Form\AbstractContentForm;

class TextContentForm extends AbstractContentForm
{

    /**
     * @var AbstractTextContentType
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    protected $text;

    public function getContent()
    {

        $this->text = new BootstrapTextBox($this);
        $this->text->label = 'Text';

        if (ProcessConfig::$debugMode) {
            $this->text->value = (new RandomText())->getText();
        }

        return parent::getContent();

    }


    protected function loadUpdateForm()
    {

        $textRow = $this->contentType->getDataRow();
        $this->text->value = $textRow->text;

    }


    protected function onSubmit()
    {

        $this->contentType->loadFromDataId($this->dataId);
        $this->contentType->parentId = $this->parentId;
        $this->contentType->text = $this->text->getValue();
        $this->contentType->saveType();

    }

}