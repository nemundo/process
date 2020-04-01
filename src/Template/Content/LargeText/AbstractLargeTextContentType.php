<?php


namespace Nemundo\Process\Template\Content\LargeText;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;
use Nemundo\Process\Template\Data\LargeText\LargeTextUpdate;

abstract class AbstractLargeTextContentType extends AbstractTreeContentType
{

    //protected $largeText;

    public $largeText;


    protected $searchIndex = false;

    public function __construct($dataId = null)
    {
        $this->formClass = LargeTextContentForm::class;
        $this->viewClass=LargeTextContentView::class;
        parent::__construct($dataId);
    }


    protected function onCreate()
    {

        $data = new LargeText();
        $data->largeText = $this->largeText;
        $this->dataId = $data->save();

    }


    protected function onIndex()
    {

        $row = $this->getDataRow();
        $this->addSearchText($row->largeText);

        //$this->saveSearchContent($row->largeText);

    }


    protected function onUpdate()
    {

        $update = new LargeTextUpdate();
        $update->largeText = $this->largeText;
        $update->updateById($this->dataId);

    }


    public function getDataRow()
    {

        return (new LargeTextReader())->getRowById($this->dataId);

    }

}