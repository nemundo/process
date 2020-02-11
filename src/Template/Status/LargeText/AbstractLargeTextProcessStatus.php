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


    public function getDataRow()
    {
        return (new LargeTextReader())->getRowById($this->dataId);

    }

}