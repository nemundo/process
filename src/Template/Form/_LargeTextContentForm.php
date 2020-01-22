<?php


namespace Nemundo\Process\Template\Form;


use Nemundo\Core\Debug\Debug;
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

        //(new Debug())->write($this->dataId);

        $p=new Paragraph($this);
        $p->content = 'dataid'.$this->dataId;

        $this->largeText = new BootstrapLargeTextBox($this);
        $this->largeText->label = 'Large Text';

        return parent::getContent();
    }


    protected function loadUpdateForm()
    {

        $row = (new LargeTextReader())->getRowById($this->dataId);
        $this->largeText->value = $row->largeText;

    }


    protected function onSubmit()
    {

        $type = new LargeTextContentType($this->dataId);
        $type->parentId = $this->parentId;
        $type->largeText = $this->largeText->getValue();
        $type->saveType();

    }


}