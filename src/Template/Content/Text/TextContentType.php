<?php


namespace Nemundo\Process\Template\Content\Text;


class TextContentType extends AbstractTextContentType  // AbstractTreeContentType
{

    public $text;

    protected function loadContentType()
    {

        parent::loadContentType();

        $this->typeLabel = 'Text';
        $this->typeId = '00b2fd69-59de-4e2d-b829-640c142253eb';
        //$this->formClass = TextContentForm::class;
        //$this->viewClass = TextContentView::class;
    }


    /*
    protected function onCreate()
    {

        $data = new TemplateText();
        $data->text = $this->text;
        $this->dataId = $data->save();

    }

    protected function onUpdate()
    {

        $update = new TemplateTextUpdate();
        $update->text = $this->text;
        $update->updateById($this->dataId);

    }

    protected function onSearchIndex()
    {
        $textRow = $this->getDataRow();
        $this->addSearchWord($textRow->text);
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
    }*/

}