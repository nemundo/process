<?php


namespace Nemundo\Process\Template\Content\Html;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class HtmlContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapLargeTextBox
     */
    private $html;

    public function getContent()
    {

        $this->html = new BootstrapLargeTextBox($this);
        $this->html->label = 'Html';

        return parent::getContent();
    }


    protected function loadUpdateForm()
    {

        $largeTextRow = $this->contentType->getDataRow();
        $this->html->value = $largeTextRow->largeText;

    }

    protected function onSubmit()
    {

        //$type = new HtmlContentType($this->dataId);
        //$type->parentId = $this->parentId;
        $this->contentType->html = $this->html->getValue();
        $this->contentType->saveType();

    }

}