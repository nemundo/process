<?php


namespace Nemundo\Process\Template\Status\LargeText;


use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

abstract class AbstractLargeTextProcessStatus extends AbstractProcessStatus
{

    public $largeText;

    protected function onCreate()
    {

        $data = new LargeText();
        $data->largeText = $this->largeText;
        $this->dataId = $data->save();

    }


    protected function onSearchIndex()
    {
        $largeTextRow = $this->getDataRow();
        $this->addSearchText($largeTextRow->largeText);
    }


    public function getDataRow()
    {
        return (new LargeTextReader())->getRowById($this->dataId);

    }

    public function getText()
    {
        return $this->getDataRow()->largeText;
    }


    public function hasViewSite()
    {
        return true;
    }


    public function getViewSite()
    {

        return $this->getParentContentType()->getViewSite();

    }

}