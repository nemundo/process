<?php


namespace Nemundo\Process\Template\Content\Text;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextDelete;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextReader;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextUpdate;

abstract class AbstractTextContentType extends AbstractTreeContentType
{

    public $text;


    public function __construct($dataId = null)
    {

        $this->formClass = TextContentForm::class;
        $this->viewClass = TextContentView::class;

        parent::__construct($dataId);
    }


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