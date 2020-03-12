<?php


namespace Nemundo\Process\Template\Status\LargeText;


use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;
use Nemundo\Process\Template\Data\LargeText\LargeTextRow;
use Nemundo\Process\Template\Data\LargeText\LargeTextUpdate;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

abstract class AbstractLargeTextProcessStatus extends AbstractProcessStatus
{

    public $largeText;

    protected $largeTextLabel = 'Large Text (Orginal)';

    protected $largeTextValidation = false;

    protected function onCreate()
    {

        $data = new LargeText();
        $data->largeText = $this->largeText;
        $this->dataId = $data->save();

    }


    protected function onUpdate()
    {

        $update = new LargeTextUpdate();
        $update->largeText = $this->largeText;
        $update->updateById($this->dataId);

    }


    protected function onIndex()
    {

        $largeTextRow = $this->getDataRow();
        $this->addSearchText($largeTextRow->largeText);
    }


    protected function onDataRow()
    {
        $this->dataRow = (new LargeTextReader())->getRowById($this->dataId);

    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|LargeTextRow
     */
    public function getDataRow()
    {
        return parent::getDataRow();
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


    public function getLargeTextLabel()
    {
        return $this->largeTextLabel;
    }


    public function getLargeTextValidation()
    {
        return $this->largeTextValidation;
    }

}