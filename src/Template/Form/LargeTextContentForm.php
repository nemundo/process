<?php


namespace Nemundo\Process\Template\Form;


use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;
use Nemundo\Process\Template\Item\LargeTextContentItem;
use Nemundo\Process\Template\Type\LargeTextContentType;

class LargeTextContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapLargeTextBox
     */
    private $largeText;

    public function getContent()
    {

        $this->largeText = new BootstrapLargeTextBox($this);
        $this->largeText->label = 'Large Text';

        return parent::getContent();
    }


    protected function loadUpdateForm()
    {

        $row = (new LargeTextReader())->getRowById($this->dataId);
        $this->largeText->value = $row->largeText;


        /*
        $reader = new LargeTextReader();
        $reader->filter->andEqual($reader->model->id, $this->dataId);
        foreach ($reader->getData() as $row) {
            //$p = new Paragraph($this);
            //$p->content = (new Html($row->largeText))->getValue();
            $this->largeText->value = $row->largeText;
        }*/


        //(new Debug())->write($row->largeText);
        //exit;

    }


    protected function onSubmit()
    {

        $type = new LargeTextContentType();
        $type->parentId = $this->parentId;
        $type->largeText = $this->largeText->getValue();
        $type->saveType();

    }


}