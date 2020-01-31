<?php


namespace Nemundo\Process\Template\Content\VersionText;


use Nemundo\Core\Random\UniqueId;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Content\Text\TextContentView;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextDelete;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextReader;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextUpdate;

class VersionTextContentType extends AbstractTreeContentType
{

    public $text;

    protected function loadContentType()
    {
        $this->typeLabel='Version Text';
        $this->typeId='058c6cdf-41b5-4b66-8474-6822278389e5';
        $this->formClass=VersionTextContentForm::class;
        $this->viewClass=TextContentView::class;

        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {

        $data = new TemplateText();
        $data->text = $this->text;
        $this->dataId = $data->save();

        $type = new TextContentType();
        $type->parentId=$this->getContentId();
        $type->text=$this->text;
        $type->saveType();


    }


    protected function onUpdate()
    {

        $update=new TemplateTextUpdate();
        $update->text=$this->text;
        $update->updateById($this->dataId);

        $type = new TextContentType();
        $type->parentId=$this->getContentId();
        $type->text=$this->text;
        $type->saveType();


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