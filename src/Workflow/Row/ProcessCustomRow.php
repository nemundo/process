<?php


namespace Nemundo\Process\Workflow\Row;


use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Data\Process\ProcessRow;



class ProcessCustomRow extends ProcessRow
{

    public function getProcess()
    {

        /** @var AbstractProcess $process */
        $process = $this->contentType->getContentType();

        return $process;

    }

}