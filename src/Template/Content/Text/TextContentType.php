<?php


namespace Nemundo\Process\Template\Content\Text;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextDelete;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextReader;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextUpdate;

class TextContentType extends AbstractTreeContentType
{

    public $text;

    protected function loadContentType()
    {
        $this->typeLabel = 'Text';
        $this->typeId = '00b2fd69-59de-4e2d-b829-640c142253eb';
        $this->formClass = TextContentForm::class;
        $this->viewClass=TextContentView::class;
    }


    protected function onCreate()
    {

        $data = new TemplateText();
        $data->text = $this->text;
        $this->dataId = $data->save();

    }

    protected function onUpdate()
    {

        $update=new TemplateTextUpdate();
       $update->text=$this->text;
       $update->updateById($this->dataId);

    }

    protected function onDelete()
    {
        (new TemplateTextDelete())->deleteById($this->dataId);

    }

    public function getDataRow()
    {
        return (new TemplateTextReader())->getRowById($this->dataId);

    }


    public function getSubject()
    {

        return $this->getDataRow()->text;
    }

}