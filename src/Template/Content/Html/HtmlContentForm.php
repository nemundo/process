<?php


namespace Nemundo\Process\Template\Content\Html;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;

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

        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function loadUpdateForm()
    {

        //$this->html->value = 'update';

        // reader


        $largeTextRow = $this->contentType->getDataRow();
        $this->html->value = $largeTextRow->largeText;

/*
        $reader = new LargeTextReader();
        $reader->filter->andEqual($reader->model->id, $this->dataId);
        foreach ($reader->getData() as $textRow) {
            $this->html->value = $textRow->largeText;
        }*/


    }

    protected function onSubmit()
    {

        $type = new HtmlContentType($this->dataId);
        $type->parentId = $this->parentId;
        $type->html = $this->html->getValue();
        $type->saveType();

    }

}